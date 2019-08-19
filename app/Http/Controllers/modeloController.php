<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatemodeloRequest;
use App\Http\Requests\UpdatemodeloRequest;
use App\Repositories\modeloRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\projeto;
use Flash;
use Response;

class modeloController extends AppBaseController
{
    /** @var  modeloRepository */
    private $modeloRepository;

    public function __construct(modeloRepository $modeloRepo)
    {
        $this->modeloRepository = $modeloRepo;
    }

    /**
     * Display a listing of the modelo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //https://www.youtube.com/watch?v=mYVl4lUadcs
        $projetos = projeto::lists('nome','id');
        $modelos = $this->modeloRepository->paginate(10);

        return view('modelos.index')
            ->with('modelos', $modelos);
    }

    /**
     * Show the form for creating a new modelo.
     *
     * @return Response
     */
    public function create()
    {
        $projetos = projeto::lists('nome','id');
        return view('modelos.create', compact('projetos'));
    }

    /**
     * Store a newly created modelo in storage.
     *
     * @param CreatemodeloRequest $request
     *
     * @return Response
     */
    public function store(CreatemodeloRequest $request)
    {
        $input = $request->all();

        $modelo = $this->modeloRepository->create($input);

        Flash::success('Modelo saved successfully.');

        return redirect(route('modelos.index'));
    }

    /**
     * Display the specified modelo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $modelo = $this->modeloRepository->find($id);

        if (empty($modelo)) {
            Flash::error('Modelo not found');

            return redirect(route('modelos.index'));
        }

        return view('modelos.show')->with('modelo', $modelo);
    }

    /**
     * Show the form for editing the specified modelo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $modelo = $this->modeloRepository->find($id);

        if (empty($modelo)) {
            Flash::error('Modelo not found');

            return redirect(route('modelos.index'));
        }

        return view('modelos.edit')->with('modelo', $modelo);
    }

    /**
     * Update the specified modelo in storage.
     *
     * @param int $id
     * @param UpdatemodeloRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemodeloRequest $request)
    {
        $modelo = $this->modeloRepository->find($id);

        if (empty($modelo)) {
            Flash::error('Modelo not found');

            return redirect(route('modelos.index'));
        }

        $modelo = $this->modeloRepository->update($request->all(), $id);

        Flash::success('Modelo updated successfully.');

        return redirect(route('modelos.index'));
    }

    /**
     * Remove the specified modelo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $modelo = $this->modeloRepository->find($id);

        if (empty($modelo)) {
            Flash::error('Modelo not found');

            return redirect(route('modelos.index'));
        }

        $this->modeloRepository->delete($id);

        Flash::success('Modelo deleted successfully.');

        return redirect(route('modelos.index'));
    }
}
