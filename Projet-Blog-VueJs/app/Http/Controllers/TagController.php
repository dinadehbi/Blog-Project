<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use App\Http\Requests\StoreTagRequest; 

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index()
    {
        $tags = $this->tagService->getAllTags();
        return response()->json($tags);
    }

    public function store(StoreTagRequest $request)
    {
        $data = $request->validated(); 

        $tag = $this->tagService->createTag($data);
        return response()->json($tag, 201);
    }

    public function show($id)
    {
        $tag = $this->tagService->getTagById($id);
        return response()->json($tag);
    }

    public function update(StoreTagRequest $request, $id) 
    {
        $data = $request->validated(); 

        $tag = $this->tagService->updateTag($id, $data);
        return response()->json($tag);
    }

    public function destroy($id)
    {
        $this->tagService->deleteTag($id);
        return response()->json(['message' => 'Tag deleted successfully']);
    }
}
