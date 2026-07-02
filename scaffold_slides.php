<?php

$basePath = __DIR__ . '/';

// 1. UPDATE ROUTES
$webFile = $basePath . 'routes/web.php';
$webContent = file_get_contents($webFile);
if (strpos($webContent, 'SlideController::class') === false) {
    $webContent = str_replace(
        "Route::resource('campaigns', \App\Http\Controllers\Admin\CampaignController::class);",
        "Route::resource('campaigns', \App\Http\Controllers\Admin\CampaignController::class);\n        Route::resource('slides', \App\Http\Controllers\Admin\SlideController::class);",
        $webContent
    );
    file_put_contents($webFile, $webContent);
}

// 2. UPDATE ADMIN LAYOUT
$layoutFile = $basePath . 'resources/views/components/admin-layout.blade.php';
$layoutContent = file_get_contents($layoutFile);
if (strpos($layoutContent, 'admin.slides.index') === false) {
    $menuItem = '
                <a href="{{ route(\'admin.slides.index\') }}" class="flex items-center px-4 py-2.5 mx-3 my-1.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs(\'admin.slides.*\') ? \'bg-green-600/10 text-green-400\' : \'text-slate-300 hover:bg-slate-800 hover:text-white\' }}">
                    <i class="fas fa-images w-6 text-center"></i> Slides (Capa)
                </a>';
    $layoutContent = str_replace(
        '<a href="{{ route(\'admin.stores.index\') }}"',
        $menuItem . "\n                <a href=\"{{ route('admin.stores.index') }}\"",
        $layoutContent
    );
    file_put_contents($layoutFile, $layoutContent);
}

// 3. WRITE CONTROLLER
$controllerFile = $basePath . 'app/Http/Controllers/Admin/SlideController.php';
$controllerContent = '<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy("id", "desc")->get();
        return view("admin.slides.index", compact("slides"));
    }

    public function create()
    {
        return view("admin.slides.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "nullable|string|max:255",
            "subtitle" => "nullable|string|max:255",
            "image" => "required|image|mimes:jpeg,png,jpg,webp|max:5000",
            "link" => "nullable|string",
            "is_active" => "boolean"
        ]);

        if ($request->hasFile("image")) {
            $validated["image"] = $request->file("image")->store("slides", "public");
        }
        $validated["is_active"] = $request->has("is_active") ? $request->is_active : true;

        Slide::create($validated);
        return redirect()->route("admin.slides.index")->with("success", "Slide adicionado com sucesso.");
    }

    public function edit(Slide $slide)
    {
        return view("admin.slides.edit", compact("slide"));
    }

    public function update(Request $request, Slide $slide)
    {
        $validated = $request->validate([
            "title" => "nullable|string|max:255",
            "subtitle" => "nullable|string|max:255",
            "image" => "nullable|image|mimes:jpeg,png,jpg,webp|max:5000",
            "link" => "nullable|string",
            "is_active" => "boolean"
        ]);

        if ($request->hasFile("image")) {
            if ($slide->image) {
                Storage::disk("public")->delete($slide->image);
            }
            $validated["image"] = $request->file("image")->store("slides", "public");
        }

        $slide->update($validated);
        return redirect()->route("admin.slides.index")->with("success", "Slide atualizado com sucesso.");
    }

    public function destroy(Slide $slide)
    {
        if ($slide->image) {
            Storage::disk("public")->delete($slide->image);
        }
        $slide->delete();
        return redirect()->route("admin.slides.index")->with("success", "Slide removido com sucesso.");
    }
}';
file_put_contents($controllerFile, $controllerContent);

// 4. WRITE VIEWS
@mkdir($basePath . 'resources/views/admin/slides', 0777, true);

$indexView = '<x-admin-layout>
    <x-slot:header>Slides (Capa)</x-slot>
    <x-slot:actions>
        <a href="{{ route(\'admin.slides.create\') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm transition-all duration-200 text-sm">Adicionar Novo</a>
    </x-slot>

    <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-[13px]">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/4">Imagem</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Título / Subtítulo</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Estado</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slides as $slide)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 group transition-colors duration-150">
                            <td class="py-4 px-4 align-top">
                                <img src="{{ asset(\'storage/\'.$slide->image) }}" class="h-16 w-32 object-cover rounded-md border border-gray-200">
                            </td>
                            <td class="py-4 px-4 align-top">
                                <strong class="text-slate-800 text-sm block mb-1">{{ $slide->title ?: \'(Sem título)\' }}</strong>
                                <span class="text-green-600">{{ $slide->subtitle }}</span>
                            </td>
                            <td class="py-4 px-4 align-top">
                                @if($slide->is_active)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-md text-xs font-semibold">Ativo</span>
                                @else
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-md text-xs font-semibold">Inativo</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 align-top">
                                <a href="{{ route(\'admin.slides.edit\', $slide->id) }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors mr-2">Editar</a>
                                <form action="{{ route(\'admin.slides.destroy\', $slide->id) }}" method="POST" class="inline-block" onsubmit="return confirm(\'Tem a certeza?\');">
                                    @csrf
                                    @method(\'DELETE\')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors">Apagar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-6 px-4 text-center text-gray-500">Nenhum slide encontrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>';
file_put_contents($basePath . 'resources/views/admin/slides/index.blade.php', $indexView);

$createView = '<x-admin-layout>
    <x-slot:header>Adicionar Slide</x-slot>
    <form action="{{ route(\'admin.slides.store\') }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-6">
        @csrf
        <div class="flex-1 space-y-5">
            <input type="text" name="title" placeholder="Título (texto branco)" class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm" value="{{ old(\'title\') }}">
            <input type="text" name="subtitle" placeholder="Subtítulo (texto verde)" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" value="{{ old(\'subtitle\') }}">
            
            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Imagem de Fundo *</label>
                    <input type="file" name="image" required class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors bg-white">
                    <p class="text-xs text-gray-500 mt-1">Tamanho recomendado: 1920x600px. Formatos: jpg, png, webp.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Link do Botão "Saiba Mais" (opcional)</label>
                    <input type="text" name="link" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" placeholder="https://..." value="{{ old(\'link\') }}">
                </div>
            </div>
        </div>
        <div class="w-full lg:w-[280px]">
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">Publicar</div>
                <div class="p-6">
                    <label class="flex items-center space-x-2 text-sm text-slate-700 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                        <span>Slide Ativo</span>
                    </label>
                </div>
                <div class="bg-gray-50/50 border-t border-gray-100 p-4 flex justify-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-all duration-200">Publicar</button>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>';
file_put_contents($basePath . 'resources/views/admin/slides/create.blade.php', $createView);

$editView = str_replace(
    ['Adicionar Slide', 'admin.slides.store', '@csrf'],
    ['Editar Slide', 'admin.slides.update\', $slide->id', "@csrf\n        @method('PUT')"],
    $createView
);
$editView = str_replace('{{ old(\'title\') }}', '{{ old(\'title\', $slide->title) }}', $editView);
$editView = str_replace('{{ old(\'subtitle\') }}', '{{ old(\'subtitle\', $slide->subtitle) }}', $editView);
$editView = str_replace('{{ old(\'link\') }}', '{{ old(\'link\', $slide->link) }}', $editView);
$editView = str_replace('required', '', $editView);
$editView = str_replace('checked', '{{ $slide->is_active ? \'checked\' : \'\' }}', $editView);

file_put_contents($basePath . 'resources/views/admin/slides/edit.blade.php', $editView);

// 5. UPDATE FRONTEND CONTROLLER
$frontFile = $basePath . 'app/Http/Controllers/FrontendController.php';
$frontContent = file_get_contents($frontFile);
if (strpos($frontContent, 'use App\Models\Slide;') === false) {
    $frontContent = str_replace("use App\Models\Service;\n", "use App\Models\Service;\nuse App\Models\Slide;\n", $frontContent);
}
if (strpos($frontContent, '$slides = Slide::') === false) {
    $frontContent = preg_replace(
        '/public function home\(\)\n    \{\n        /',
        "public function home()\n    {\n        \$slides = Slide::where('is_active', true)->orderBy('id', 'asc')->get();\n        ",
        $frontContent
    );
    $frontContent = str_replace(
        "compact('stores', 'recipes', 'campaigns', 'services')",
        "compact('stores', 'recipes', 'campaigns', 'services', 'slides')",
        $frontContent
    );
    file_put_contents($frontFile, $frontContent);
}

echo "Admin Slide module and FrontendController updated successfully.\n";
