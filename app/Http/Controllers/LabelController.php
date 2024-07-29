<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Http\Requests\TaskStatusRequest;
use App\Models\Label;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::all();
        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('labels.create', ['label' => new Label()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LabelRequest $request)
    {
        $this->saveLabel(new Label(), $request);
        flash('Метка успешно создана')->success();
        return redirect()->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LabelRequest $request, Label $label)
    {
        $this->saveLabel($label, $request);
        flash('Метка успешно обновлена')->success();
        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        try {
            $label->delete();
            flash('Метка успешно удалёна')->success();
        } catch (\Exception $e) {
            flash('Не удалось удалить метку')->error();
        }
        return redirect()->route('labels.index');
    }

    private function saveLabel(Label $label, LabelRequest $request)
    {
        $validated = $request->validated();
        $label->fill($validated);
        $label->save();
    }
}
