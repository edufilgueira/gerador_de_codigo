<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateprojetoRequest;
use App\Http\Requests\UpdateprojetoRequest;
use App\Repositories\projetoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class projetoController extends AppBaseController
{
    /** @var  projetoRepository */
    private $projetoRepository;

    public function __construct(projetoRepository $projetoRepo)
    {
        $this->projetoRepository = $projetoRepo;
    }

    /**
     * Display a listing of the projeto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $projetos = $this->projetoRepository->paginate(10);

        return view('projetos.index')
            ->with('projetos', $projetos);
    }

    /**
     * Show the form for creating a new projeto.
     *
     * @return Response
     */
    public function create()
    {
        return view('projetos.create');
    }

    /**
     * Store a newly created projeto in storage.
     *
     * @param CreateprojetoRequest $request
     *
     * @return Response
     */
    public function store(CreateprojetoRequest $request)
    {
        $input = $request->all();

        $projeto = $this->projetoRepository->create($input);

        Flash::success('Projeto saved successfully.');

        return redirect(route('projetos.index'));
    }

    /**
     * Display the specified projeto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $projeto = $this->projetoRepository->find($id);

        if (empty($projeto)) {
            Flash::error('Projeto not found');

            return redirect(route('projetos.index'));
        }

        return view('projetos.show')->with('projeto', $projeto);
    }

    /**
     * Show the form for editing the specified projeto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $projeto = $this->projetoRepository->find($id);

        if (empty($projeto)) {
            Flash::error('Projeto not found');

            return redirect(route('projetos.index'));
        }

        return view('projetos.edit')->with('projeto', $projeto);
    }

    /**
     * Update the specified projeto in storage.
     *
     * @param int $id
     * @param UpdateprojetoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprojetoRequest $request)
    {
        $projeto = $this->projetoRepository->find($id);

        if (empty($projeto)) {
            Flash::error('Projeto not found');

            return redirect(route('projetos.index'));
        }

        $projeto = $this->projetoRepository->update($request->all(), $id);

        Flash::success('Projeto updated successfully.');

        return redirect(route('projetos.index'));
    }

    /**
     * Remove the specified projeto from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $projeto = $this->projetoRepository->find($id);

        if (empty($projeto)) {
            Flash::error('Projeto not found');

            return redirect(route('projetos.index'));
        }

        $this->projetoRepository->delete($id);

        Flash::success('Projeto deleted successfully.');

        return redirect(route('projetos.index'));
    }
}
