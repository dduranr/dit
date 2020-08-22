<?php

namespace App\Http\Controllers;

use Auth;
use App\Book;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'author' => 'required',
            'category' => 'required',
        ]);
        try {
            $usuario = Auth::user();
            if (!is_null($usuario)) {
                $titulo = $request->get('name');
                Book::create([
                    'name' => $request->get('name'),
                    'slug' => Str::slug($titulo),
                    'author' => $request->get('author'),
                    'category' => $request->get('category'),
                    'borrow' => $request->get('borrow'),
                    'published_date' => date('Y-m-d H:i:s'),
                    'user' => $usuario->id,
                ]);
            } else {
                $msg_error = 'You are probably NOT LOGGED into the system yet. Please login and try again.';
                return back()->with('msg_error', $msg_error);
            }
        } catch (\Throwable $th) {
            $msg_error = $th->getMessage();
            if (strpos($msg_error, 'non-object') !== false) {
                $msg_error = $msg_error . '. You are probably NOT LOGGED into the system yet. Please login and try again.';
            }
            return back()->with('msg_error', $msg_error);
        }
        return back()->with('msg_success', 'The book was created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $categories = Category::all();
        $data = array('cats'=>$categories, 'book'=>$book);
        return view('show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request, [
            'name' => 'required',
            'author' => 'required',
            'category' => 'required',
        ]);
        try {
            // $record = Book::where([['id', $book]])->first();
            // dd($book->borrow);
            $prestar = false;
            $msg_prestar = '';
            if((bool)$book->borrow===false && (bool)$request->get('borrow')===true) $prestar = true;
            if((bool)$book->borrow===true && (bool)$request->get('borrow')===true) $msg_prestar = 'Someone has borrowed the book. Try another day.';

            $usuario = Auth::user();
            if (!is_null($usuario)) {
                $titulo = $request->get('name');
                if($prestar) {
                    $book->update([
                        'name' => $request->get('name'),
                        'slug' => Str::slug($titulo),
                        'author' => $request->get('author'),
                        'category' => $request->get('category'),
                        'borrow' => 1,
                        'user' => $usuario->id,
                    ]);
                }
                else {
                    $book->update([
                        'name' => $request->get('name'),
                        'slug' => Str::slug($titulo),
                        'author' => $request->get('author'),
                        'category' => $request->get('category'),
                    ]);
                }
            } else {
                $msg_error = 'You are probably NOT LOGGED into the system yet. Please login and try again.';
                return back()->with('msg_error', $msg_error);
            }
        } catch (\Throwable $th) {
            $msg_error = $th->getMessage();
            if (strpos($msg_error, 'non-object') !== false) {
                $msg_error = $msg_error . '. You are probably NOT LOGGED into the system yet. Please login and try again.';
            }
            return back()->with('msg_error', $msg_error);
        }
        return back()->with('msg_success', 'Book successfully updated. '. $msg_prestar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        try {
            $usuario = Auth::user();
            if (!is_null($usuario)) {
                $book->delete();
            } else {
                $msg_error = 'You are probably NOT LOGGED into the system yet. Please login and try again.';
                return back()->with('msg_error', $msg_error);
            }
        } catch (\Throwable $th) {
            $msg_error = $th->getMessage();
            if (strpos($msg_error, 'non-object') !== false) {
                $msg_error = $msg_error . '. You are probably NOT LOGGED into the system yet. Please login and try again.';
            }
            return back()->with('msg_error', $msg_error);
        }
        return back()->with('msg_success', 'Book deleted successfully');
    }

    public function datatables()
    {
        // Creo que aquí es donde tengo que mezclar la info con las categorías
        // $libros = Book::select(['id', 'name', 'author','category','published_date', 'user']);

        $query = Book::addSelect(['categoryName' => Category::select('name')
            ->whereColumn('books.category', 'category.id')
            ->orderBy('books.name', 'desc')])
        ->addSelect(['userName' => User::select('name')
            ->whereColumn('books.user', 'users.id')
            ->orderBy('books.name', 'desc')]);

        // $query = Book::query()
        //     ->join('category', 'books.category', '=', 'category.id')
        //     ->select(['books.id AS books_id', 'category.id AS category_id', 'books.name', 'author', 'published_date', 'user'])
        //     ->orderByRaw('books.id', 'desc');

        return datatables()
            // ->eloquent(Book::query())
            ->eloquent($query)
            ->addColumn('actions', 'actions')
            ->rawColumns(['actions']) // Para que reconozca los botones como HTML: renderizar todo excepto actions
            ->toJson();
    }






    public function available(Request $request, Book $book)
    {
        try {
            $usuario = Auth::user();
            if (!is_null($usuario)) {

                if ($book->borrow) {
                    $book->update([
                        'borrow' => 0,
                        'user' => null,
                    ]);
                } else {
                    $book->update([
                        'borrow' => 1,
                        'user' => $usuario->id,
                    ]);
                }
            } else {
                $msg_error = 'You are probably NOT LOGGED into the system yet. Please login and try again.';
                return back()->with('msg_error', $msg_error);
            }
        } catch (\Throwable $th) {
            $msg_error = $th->getMessage();
            if (strpos($msg_error, 'non-object') !== false) {
                $msg_error = $msg_error . '. You are probably NOT LOGGED into the system yet. Please login and try again.';
            }
            return back()->with('msg_error', $msg_error);
        }
        return back()->with('msg_success', 'Book successfully updated. ');
    }

}
