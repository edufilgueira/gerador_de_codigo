<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCampoRequest;
use App\Http\Requests\UpdateCampoRequest;
use App\Repositories\CampoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Modelo;
use Flash;
use Response;

class CampoController extends AppBaseController
{
    /** @var  CampoRepository */
    private $campoRepository;

    public function __construct(CampoRepository $campoRepo)
    {
        $this->campoRepository = $campoRepo;
    }

    /**
     * Display a listing of the Campo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $campos = $this->campoRepository->paginate(10);

        return view('campos.index')
            ->with('campos', $campos);
    }

    /**
     * Show the form for creating a new Campo.
     *
     * @return Response
     */
    public function create()
    {
        $modelos = Modelo::pluck('singular', 'id');
        return view('campos.create', compact('id', 'modelos'));
    }

    /**
     * Store a newly created Campo in storage.
     *
     * @param CreateCampoRequest $request
     *
     * @return Response
     */
    public function store(CreateCampoRequest $request)
    {
        $input = $request->all();

        $campo = $this->campoRepository->create($input);

        Flash::success('Campo saved successfully.');

        return redirect(route('campos.index'));
    }

    /**
     * Display the specified Campo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $campo = $this->campoRepository->find($id);

        if (empty($campo)) {
            Flash::error('Campo not found');

            return redirect(route('campos.index'));
        }

        return view('campos.show')->with('campo', $campo);
    }

    /**
     * Show the form for editing the specified Campo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $campo = $this->campoRepository->find($id);
        $modelos = Modelo::pluck('singular', 'id');

        if (empty($campo)) {
            Flash::error('Campo not found');

            return redirect(route('campos.index'));
        }

        return view('campos.edit', compact('id', 'modelos'))->with('campo', $campo);
    }

    /**
     * Update the specified Campo in storage.
     *
     * @param int $id
     * @param UpdateCampoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCampoRequest $request)
    {
        $campo = $this->campoRepository->find($id);

        if (empty($campo)) {
            Flash::error('Campo not found');

            return redirect(route('campos.index'));
        }

        $campo = $this->campoRepository->update($request->all(), $id);

        Flash::success('Campo updated successfully.');

        return redirect(route('campos.index'));
    }

    /**
     * Remove the specified Campo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $campo = $this->campoRepository->find($id);

        if (empty($campo)) {
            Flash::error('Campo not found');

            return redirect(route('campos.index'));
        }

        $this->campoRepository->delete($id);

        Flash::success('Campo deleted successfully.');

        return redirect(route('campos.index'));
    }
}
