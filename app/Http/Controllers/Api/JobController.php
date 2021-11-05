<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class JobController extends Controller
{
    /**
     * fetch all jobs
     *
     * @return  jsonResponse
     */
    public function index(): JsonResponse
    {
        $jobs = Job::all();
        return new JsonResponse(['data' => $jobs], 202);
    }

    /**
     * show individual job
     *
     * @param Job $job
     * @return JsonResponse
     */
    public function show(Job $job): JsonResponse
    {
        if (!$job) {
            return new JsonResponse(['message' => 'Record not found'], 404);
        }
        return new JsonResponse(['data' => $job], 202);
    }

    /**
     * validate and save a new job in database
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required ',
            'description' => 'required',
            'job_type' => 'required',
            'work_conditions' => 'required',
            'categories' => 'required',
        ]);

        Job::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'job_type' => $request['job_type'],
            'work_conditions' => $request['work_conditions'],
            'categories' => $request['categories']
        ]);
        return new JsonResponse(null,201);
    }

    /**
     * update a job
     *
     * @param Job $job
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Job $job, Request $request): JsonResponse
    {
        if (!$job) {
            return new JsonResponse(['message' => 'record not found'], 404);
        }
        $job->update($request->all());
        return new JsonResponse($job, 202);
    }

    /**
     * delete a job from the db
     *
     * @param Job $job
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Job $job, Request $request): JsonResponse
    {
        if (!$job) {
            return new JsonResponse(['message' => 'record not found'], 404);
        }
        $job->delete($request->all());
        return new JsonResponse($job, 202);
    }

    /**
     * search for a job
     *
     */
    public function search($title)
    {
      return Job::where('title', 'like', '%'.$title.'%')->get();
    }

    /**
     * applying for  JOB
     *
     * @param Request $request
     * @param Job $job
     *
     */
    public function apply(Request $request,Job $job)
    {
      $request->validate([
          'name' => 'required',
          'email' => 'required',
      ]);

      $applicant=Applicant::updateorCreate([
          'email'=>$request->email],
          ['name' => $request->name]
      );


        $applicant->jobs()->sync($job->id);

        return new JsonResponse(['message'=>'application suuccesful'],200);
    }
}
