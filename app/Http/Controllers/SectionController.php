<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Section;
use App\User;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the sections.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sections = Section::paginate(5);
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new sections.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();
        return view('sections.create', compact('users'));
    }

    /**
     * Store a newly created section in storage.
     *
     * @param SectionRequest $sectionRequest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SectionRequest $sectionRequest)
    {
        $section = Section::create([
            'name' => $sectionRequest->input('name'),
            'description' => $sectionRequest->input('description'),
            'logo' => $sectionRequest->hasFile('logo') ?
                $sectionRequest->file('logo')->store('/', 'logo') : null,
        ]);
        $section->users()->attach($sectionRequest->input('users'));
        return redirect('/sections')->with('status', __('sections.add_success'));
    }

    /**
     * Show the form for editing the specified section.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $section = Section::find($id);
        $users = User::all();
        return view('sections.edit', compact('section','users'));
    }

    /**
     * Update the specified section in storage.
     *
     * @param SectionRequest $sectionRequest
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(SectionRequest $sectionRequest, $id)
    {
        $section = Section::find($id);
        $section->name = $sectionRequest->input('name');
        $section->description = $sectionRequest->input('description');
        if ($sectionRequest->hasFile('logo'))
        {
            $section->logo = $sectionRequest->file('logo')->store('/', 'logo');
        }
        $section->save();
        $section->users()->sync($sectionRequest->input('users'));
        return redirect('/sections')->with('status', __('sections.edit_success'));
    }

    /**
     * Remove the specified section from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();
        return redirect('/sections')->with('status', __('sections.del_success'));
    }
}
