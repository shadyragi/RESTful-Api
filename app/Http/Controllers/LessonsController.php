<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Response;

use App\lessons;

use App\Acme\Transformers\LessonTransformer;

class LessonsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $LessonTransformer;

    public function __construct(LessonTransformer $LessonTransformer)
    {
        $this->LessonTransformer = $LessonTransformer;
        $this->middleware('auth.basic', ['only' => ['store', 'update']]);

    }
    public function index()
    {
        //
        session(['blabla' => 'testing']);
        if(session()->has('blabla'))
        {
            dd('done');
        }

        $limit = request('limit') ?: 5;

        $lessons = lessons::paginate($limit);
        
        return $this->setStatusCode(200)->response([

            'data' => $this->LessonTransformer->transformCollection($lessons->all()),
            'paginator' => [
                'total_count' => $lessons->total(),
                'per_page'    => $lessons->perPage(),
                'total_pages' => ceil($lessons->total() / $lessons->perPage()),
                'next'        => $lessons->nextPageUrl(),
                'previous'    => $lessons->previousPageUrl(),
            ]            
            ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('lessonform');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         if(!$request->has(['title', 'body']))
         {
            return $this->respondBadRequest();
         }

         Lessons::create($request->except(['submit', '_token']));

         return $this->respondCreated();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $lesson = lessons::find($id);
        if(! $lesson) 
        {
           return $this->respondNotFound('lesson not found');
        }

       return $this->response([
        'data' => $this->LessonTransformer->transform($lesson)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $lesson = lessons::findOrFail($id);
        return view('editform', ['title' => $lesson->title, 'body' => $lesson->body, 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $lesson = lessons::find($id);

        $lesson->title = request('title');

        $lesson->body  = request('body');

        if($lesson->save())
        {
            return $this->respondUpdated('Lesson Has Been Updated Successfully');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(lessons::destroy($id))
        {
            return $this->respondDeleted('Lesson Has Been Deleted Successfully');
        }
        return $this->respondNotFound("lesson not found");

    }

   



}
