<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBuildBasicsRequest;
use App\Http\Requests\UpdateBuildDetailsRequest;
use App\Http\Requests\UpdateBuildIntroductionRequest;
use App\Http\Requests\UpdateBuildStatusRequest;
use App\Http\Requests\UpdateSkillTreeRequest;
use App\Models\Build;
use App\Services\BuildService;
use App\Services\ToastService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BuildController extends Controller
{
    private ToastService $toastService;
    private BuildService $buildService;

    public function __construct(BuildService $buildService, ToastService $toastService)
    {
        $this->buildService = $buildService;
        $this->toastService = $toastService;
    }

    public function index()
    {
        return Inertia::render('Build/Index');
    }

    public function preview(Build $build)
    {
        return Inertia::render('Build/Preview', [
            'build' => $build->load('sections.sectionable', 'diabloClass.skillCategories.skills'),
        ]);
    }

    public function show(Build $build)
    {
        return Inertia::render('Build/Show', [
            'build' => $build->load('sections.sectionable', 'diabloClass.skillCategories.skills'),
            'isAuthor' => $build->user_id == Auth::id(),
        ]);
    }

    public function delete(Build $build)
    {
        $response = $this->buildService->delete($build);
        $rData = $response->getData(true);

        if ($rData['success']) {
            $this->toastService->setToast('success', 'Deleted', $rData['message']);
        } else {
            $this->toastService->setToast('error', 'Delete Failed', $rData['message']);
        }

        return redirect(route('build.own.index'));
    }

    public function myBuilds()
    {
        return Inertia::render('Build/MyBuilds', [
            'builds' => Auth::user()->builds()->get(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:builds,name'],
                'class_id' => ['required'],
            ]);

            $build = Build::create([
                'name' => $request->name,
                'diablo_class_id' => $request->class_id,
                'user_id' => Auth::id(),
            ]);

            $this->toastService->setToast('success', 'Created', 'Guide created!');
        } catch (Exception $e) {
            $this->toastService->setToast('error', 'Creation Failed', $e->getMessage());
        }

        return redirect()->route('build.edit.introduction', $build);
    }

    public function edit(Build $build)
    {
        return Inertia::render('Build/Edit', [
            'build' => $build,
        ]);
    }

    public function update(Build $build, UpdateBuildBasicsRequest $request)
    {
        $data = $request->validated();

        $response = $this->buildService->updateBasics($build, $data);
        $rData = $response->getData(true);

        if ($rData['success']) {
            $this->toastService->setToast('success', 'Updated', $rData['message']);
        } else {
            $this->toastService->setToast('error', 'Update Failed', $rData['message']);
        }

        return redirect(route('build.edit', $build));
    }


    public function editIntroduction(Build $build)
    {
        return Inertia::render('Build/Introduction', [
            'build' => $build,
        ]);
    }

    public function updateIntroduction(Build $build, UpdateBuildIntroductionRequest $request)
    {
        $data = $request->validated();

        $response = $this->buildService->updateIntroduction($build, $data['introduction']);
        $rData = $response->getData(true);

        if ($rData['success']) {
            $this->toastService->setToast('success', 'Updated', $rData['message']);
        } else {
            $this->toastService->setToast('error', 'Update Failed', $rData['message']);
        }

        return redirect(url()->previous());
    }

    public function editGear(Build $build)
    {
        return Inertia::render('Build/Gear', [
            'build' => $build,
        ]);
    }

    public function editSkillTree(Build $build)
    {
        // Load the relevant class data
        $class = $build->diabloClass->load('skillCategories', 'skillCategories.skills');
        return Inertia::render('Build/SkillTree', [
            'build' => $build,
            'classData' => $class,
        ]);
    }

    public function updateSkillTree(Build $build, UpdateSkillTreeRequest $request)
    {
        $data = $request->validated();

        $response = $this->buildService->updateSkillTree($build, $data);
        $rData = $response->getData(true);

        if ($rData['success']) {
            $this->toastService->setToast('success', 'Updated', $rData['message']);
        } else {
            $this->toastService->setToast('error', 'Update Failed', $rData['message']);
        }

        return redirect(url()->previous());
    }

    public function updateStatus(Build $build, UpdateBuildStatusRequest $request)
    {
        $data = $request->validated();

        $response = $this->buildService->updateStatus($build, $data['active']);
        $rData = $response->getData(true);

        if ($rData['success']) {
            $this->toastService->setToast('success', 'Updated', $rData['message']);
        } else {
            $this->toastService->setToast('error', 'Update Failed', $rData['message']);
        }

        return redirect(url()->previous());
    }

    public function editSections(Build $build)
    {
        $build->load('sections.sectionable');
        $sections = $build->sections->map(function ($section) {
            return [
                'id' => $section->id,
                'title' => $section->title,
                'content' => $section->sectionable->content,
                'type' => $section->sectionable_type,
                'order' => $section->order,
                'is_new' => false,
            ];
        });

        return Inertia::render('Build/Details', [
            'build' => $build,
            'sections' => $sections,
        ]);
    }

    public function updateSections(Build $build, UpdateBuildDetailsRequest $request)
    {
        $data = $request->validated();

        $response = $this->buildService->updateDetails($build, $data['sections']);
        $rData = $response->getData(true);

        if ($rData['success']) {
            $this->toastService->setToast('success', 'Updated', $rData['message']);
        } else {
            $this->toastService->setToast('error', 'Update Failed', $rData['message']);
        }

        return redirect(route('build.edit.sections', $build));
    }
}
