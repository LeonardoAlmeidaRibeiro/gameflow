<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExerciseCategoryValidator;
use App\Models\ExerciseCategory;
use App\Models\MuscleGroup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ExerciseCategoryController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $muscleGroups = MuscleGroup::query()
            ->orderBy('nome')
            ->get();
        $exerciseCategories = ExerciseCategory::query()
            ->with('muscleGroup')
            ->orderBy('nome')
            ->get();

        return view('exercise_categories.index', compact('user', 'muscleGroups', 'exerciseCategories'));
    }

    public function store(ExerciseCategoryValidator $request)
    {
        try {
            $data = $request->validated();
            $data['imagem'] = $this->storeImage($request);

            $exerciseCategory = ExerciseCategory::create($data);
            $exerciseCategory->load('muscleGroup');

            return response()->json([
                'success' => true,
                'id' => $exerciseCategory->id,
                'message' => 'Categoria de exercício criada com sucesso.',
                'record' => $this->recordPayload($exerciseCategory),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(ExerciseCategoryValidator $request, ExerciseCategory $exerciseCategory)
    {
        try {
            $data = $request->validated();
            $image = $this->storeImage($request);

            if ($image) {
                $this->deleteImage($exerciseCategory->imagem);
                $data['imagem'] = $image;
            } else {
                unset($data['imagem']);
            }

            $exerciseCategory->update($data);
            $exerciseCategory->load('muscleGroup');

            return response()->json([
                'success' => true,
                'message' => 'Categoria de exercício editada com sucesso.',
                'record' => $this->recordPayload($exerciseCategory),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(ExerciseCategory $exerciseCategory)
    {
        try {
            $this->deleteImage($exerciseCategory->imagem);
            $exerciseCategory->delete();

            return response()->json([
                'success' => true,
                'message' => 'Categoria de exercício excluída com sucesso.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    private function storeImage(Request $request): ?string
    {
        $file = $request->file('imagem');

        if (!$file) {
            return null;
        }

        if (!$file->isValid() || !$file->getRealPath()) {
            throw new Exception($this->uploadErrorMessage((int) $file->getError()));
        }

        $directory = public_path('storage/exercise-categories');

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $extension = $file->getClientOriginalExtension() ?: $file->guessExtension() ?: 'gif';
        $filename = Str::uuid() . '.' . strtolower($extension);

        $file->move($directory, $filename);

        return 'exercise-categories/' . $filename;
    }

    private function deleteImage(?string $path): void
    {
        if (!$path) {
            return;
        }

        $fullPath = public_path('storage/' . $path);

        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }

    private function uploadErrorMessage(int $error): string
    {
        switch ($error) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return 'A imagem ultrapassou o limite configurado no PHP. O limite esperado é 100MB; reinicie o Laragon/Apache após atualizar a configuração.';
            case UPLOAD_ERR_PARTIAL:
                return 'A imagem foi enviada apenas parcialmente. Tente enviar novamente.';
            case UPLOAD_ERR_NO_FILE:
                return 'Nenhuma imagem foi enviada.';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'O PHP não encontrou a pasta temporária de upload.';
            case UPLOAD_ERR_CANT_WRITE:
                return 'O servidor não conseguiu gravar a imagem no disco.';
            case UPLOAD_ERR_EXTENSION:
                return 'Uma extensão do PHP bloqueou o upload da imagem.';
            default:
                return 'A imagem não chegou corretamente ao servidor. Verifique o tamanho do arquivo e tente enviar novamente.';
        }
    }

    private function recordPayload(ExerciseCategory $exerciseCategory): array
    {
        return [
            'id' => $exerciseCategory->id,
            'muscle_group_id' => $exerciseCategory->muscle_group_id,
            'muscle_group_nome' => data_get($exerciseCategory, 'muscleGroup.nome', '-'),
            'nome' => $exerciseCategory->nome,
            'descricao' => $exerciseCategory->descricao,
            'imagem' => $exerciseCategory->imagem,
            'imagem_url' => $exerciseCategory->imagem_url,
        ];
    }
}
