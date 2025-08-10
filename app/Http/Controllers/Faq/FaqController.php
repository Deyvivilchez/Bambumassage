<?php

namespace App\Http\Controllers\Faq;

use App\Http\Controllers\Controller;
use App\Models\Faq\Faq;
use App\Models\Faq\FaqCategoria;
use App\Models\Faq\FaqSubcategoria;
use App\Models\sisgedo\encuestas\Preguntas;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function buscar(Request $request)
    {
        $query = strtolower($this->limpiarTexto($request->input('pregunta')));

        $faqs = Faq::search($query)->take(5)->get();

        return response()->json(['resultados' => $faqs]);
    }

    private function limpiarTexto($texto)
    {
        $stopwords = ['de', 'la', 'el', 'mi', 'es', 'en', 'un', 'una', 'para', 'con', 'que', 'por', 'los', 'las', 'al', 'del', 'cómo', 'cuál', 'quién'];
        $palabras = explode(' ', strtolower($texto));
        $palabras = array_filter($palabras, function ($p) use ($stopwords) {
            return !in_array($p, $stopwords);
        });
        return implode(' ', $palabras);
    }


    public function index()
    {
        return response()->json(
            Faq::with(['subcategoria.categoria', 'categoria'])
                ->orderBy('id', 'desc')
                ->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pregunta' => 'required|string',
            'respuesta' => 'required|string',
            'id_categoria' => 'nullable|exists:faqs_categoria,id',
            'id_subcategoria' => 'nullable|exists:faqs_subcategoria,id',
        ]);

        if (!empty($validated['id_subcategoria'])) {
            $validated['id_categoria'] = null;
        }

        $faq = Faq::create($validated);

        return response()->json($faq, 201);
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $validated = $request->validate([
            'pregunta' => 'required|string',
            'respuesta' => 'required|string',
            'id_categoria' => 'nullable|exists:faqs_categoria,id',
            'id_subcategoria' => 'nullable|exists:faqs_subcategoria,id',
        ]);

        // Mantener valores anteriores si no se envían
        if (!array_key_exists('id_categoria', $validated)) {
            $validated['id_categoria'] = $faq->id_categoria;
        }
        if (!array_key_exists('id_subcategoria', $validated)) {
            $validated['id_subcategoria'] = $faq->id_subcategoria;
        }

        // Si se asigna subcategoría, limpiar id_categoria
        if (!empty($validated['id_subcategoria'])) {
            $validated['id_categoria'] = null;
        }

        $faq->update($validated);

        return response()->json($faq);
    }


    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();
        return response()->json(['verificado' => true]);
    }

    public function sugerencias()
    {
        $categorias = FaqCategoria::with([
            'subcategorias.faqs',
            'faqsDirectos' // <- agregaremos esta relación
        ])->get();

        return response()->json($categorias);
    }

    public function index_cat_faqs()
    {
        $categorias = FaqCategoria::all();
        return response()->json($categorias);
    }

    public function store_categoria_pregunta(Request $request)
    {
        try {
            $categorias = new FaqCategoria;
            $categorias->descripcion = $request->descripcion;
            $categorias->save();
            return response()->json(['verificado' => true, 'categorias' => $categorias]);
        } catch (Exception $e) {
            return response()->json(['verificado' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy_categoria_pregunta($id)
    {
        FaqCategoria::findOrFail($id)->delete();
        return response()->json(['verificado' => true]);
    }

    public function update_categoria_pregunta(Request $request, $id)
    {
        $faq = FaqCategoria::findOrFail($id);
        $faq->update($request->validate([
            'descripcion' => 'required|string',
        ]));
        return response()->json(['verificado' => true, 'faq' => $faq]);
    }

    // Listar subcategorías
    public function index_subcategorias()
    {
        $subcategorias = FaqSubcategoria::with('categoria')->orderBy('id', 'desc')->get();
        return response()->json($subcategorias);
    }

    // Registrar subcategoría
    public function store_subcategoria(Request $request)
    {
        try {
            $data = $request->validate([
                'descripcion' => 'required|string',
                'id_categoria' => 'required|exists:faqs_categoria,id',
            ]);

            $subcategoria = FaqSubcategoria::create($data);
            return response()->json(['verificado' => true, 'subcategoria' => $subcategoria]);
        } catch (Exception $e) {
            return response()->json(['verificado' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // Actualizar subcategoría
    public function update_subcategoria(Request $request, $id)
    {
        $subcategoria = FaqSubcategoria::findOrFail($id);

        $data = $request->validate([
            'descripcion' => 'required|string',
            'id_categoria' => 'required|exists:faqs_categoria,id',
        ]);

        $subcategoria->update($data);

        return response()->json(['verificado' => true, 'subcategoria' => $subcategoria]);
    }

    // Eliminar subcategoría (soft delete)
    public function destroy_subcategoria($id)
    {
        FaqSubcategoria::findOrFail($id)->delete();
        return response()->json(['verificado' => true]);
    }

    public function registrarEvento(Request $request)
    {
        $fecha = $request->fecha
            ? Carbon::parse($request->fecha)->format('Y-m-d H:i:s')
            : now();

        DB::table('chatbot_eventos')->insert([
            'evento' => $request->evento,
            'datos' => json_encode($request->datos),
            'navegador' => $request->navegador,
            'fecha' => $fecha,
            'created_at' => now(),
        ]);

        return response()->json(['ok' => true]);
    }

    public function guardarConsultaSinRespuesta(Request $request)
    {
        DB::table('chatbot_consultas_pendientes')->insert([
            'pregunta' => $request->pregunta,
            'fecha' => $request->fecha ?? now(),
            'navegador' => $request->navegador ?? null,
            'created_at' => now()
        ]);

        return response()->json(['ok' => true]);
    }

    public function indexConsultaSinRespuesta(Request $request)
    {
        $consultas = DB::table('chatbot_consultas_pendientes')
            ->orderBy('fecha', 'desc')
            ->get();

        return response()->json([
            'consultas' => $consultas
        ]);
    }

    public function update_preguntaSinRespuesta($id, Request $request)
    {
        try {
            $consulta = DB::table('chatbot_consultas_pendientes')
                ->where('id', $id)
                ->first(); // para obtener un solo resultado

            if (!$consulta) {
                return response()->json(['error' => 'Consulta no encontrada'], 404);
            }
            $estado = in_array((int) $request->estado, [0, 1], true) ? (bool) $request->estado : null;

            // Ejemplo de actualización
            DB::table('chatbot_consultas_pendientes')
                ->where('id', $id)
                ->update([
                    'estado'     => $estado,
                    'updated_at' => now()
                ]);

            return response()->json(['ok' => true, 'mensaje' => 'Consulta actualizada']);
        } catch (Exception $e) {
            return response()->json(['verificado' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
