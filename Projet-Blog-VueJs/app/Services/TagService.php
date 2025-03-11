<?php
// app/Services/TagService.php
namespace App\Services;

use App\Repositories\TagRepository;

class TagService
{
    protected $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getAllTags()
    {
        return $this->tagRepository->getAll();
    }

    public function getTagById($id)
    {
        return $this->tagRepository->findById($id);
    }

    public function createTag($data)
    {
        return $this->tagRepository->create($data);
    }

    public function updateTag($id, $data)
    {
        return $this->tagRepository->update($id, $data);
    }

    public function deleteTag($id)
    {
        return $this->tagRepository->delete($id);
    }
}
