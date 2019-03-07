<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OrganizationCreateRequest;
use App\Http\Requests\OrganizationUpdateRequest;
use App\Repositories\OrganizationRepository;
use App\Validators\OrganizationValidator;

/**
 * Class OrganizationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CRUDOrganizationsController extends Controller
{
    /**
     * @var OrganizationRepository
     */
    protected $repository;

    /**
     * @var OrganizationValidator
     */
    protected $validator;

    /**
     * OrganizationsController constructor.
     *
     * @param OrganizationRepository $repository
     * @param OrganizationValidator $validator
     */
    public function __construct(OrganizationRepository $repository, OrganizationValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $organizations = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $organizations,
            ]);
        }

        return view('organizations.index', compact('organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrganizationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OrganizationCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $organization = $this->repository->create($request->all());

            $response = [
                'message' => 'Organization created.',
                'data'    => $organization->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organization = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $organization,
            ]);
        }

        return view('organizations.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organization = $this->repository->find($id);

        return view('organizations.edit', compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrganizationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OrganizationUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $organization = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Organization updated.',
                'data'    => $organization->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Organization deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Organization deleted.');
    }
}
