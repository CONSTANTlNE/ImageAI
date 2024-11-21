@extends('admin.layout')

@php

//   dd(app()->getLocale());
 @endphp
@section('projects')


    <button type="button" class="m-1 ms-0 ti-btn ti-btn-primary-full" data-hs-overlay="#hs-full-screen-modal">
        Add New Project
    </button>
    <div id="hs-full-screen-modal" class="hs-overlay hidden ti-modal">
        <div class="hs-overlay-open:mt-0 ti-modal-box mt-10 !m-0 !max-w-full !w-full">
            <div class="ti-modal-content !rounded-none">
                <div class="ti-modal-header">
                    <h6 class="ti-modal-title">
                        New Project
                    </h6>
                    <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#hs-full-screen-modal">
                        <span class="sr-only">Close</span>
                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z" fill="currentColor"/>
                        </svg>
                    </button>
                </div>
                {{--FORM--}}
                <form action="{{route('createProject')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="ti-modal-body">

                    <div class="flex justify-center">
                        <div class=" w-full">
                            <div class="">
                                <div class="box-header justify-between">
                                    <div class="box-title">
                                        Create Project {{app()->getLocale()}}
                                    </div>
                                </div>
                                <template id="featruresTemplate">
                                    <div class="box-body" >
                                        <div class="mb-4">
                                            <label for="form-password" class="form-label text-[.875rem] text-black">
                                                Feature Name</label>
                                            <input name="feturename[]" type="text" class="form-control" id="form-password" placeholder="">
                                        </div>
                                        <div class="mb-4">
                                            <label for="featuredescription" class="form-label">Feature Description</label>
                                            <textarea name="featuredescription[]" class="form-control" id="featuredescription" rows="3"></textarea>
                                        </div>
                                        <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                                            <div>
                                                <label for="file-input" class="sr-only">Type file</label>
                                                <input type="file" name="featureimage[]" id="file-input" class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10
                                                 file:border-0
                                                file:bg-gray-200 file:me-4
                                                file:py-3 file:px-4
                                                dark:file:bg-black/20 dark:file:text-white/50">
                                            </div>
                                        </div>
                                        <button type="button" class="removeButton">Remove</button>
                                    </div>
                                </template>
                                <div class="box-body" >

                                    <div class="mb-4">
                                        <label for="form-password" class="form-label text-[.875rem] text-black">
                                            Project Name {{app()->getLocale()}}</label>
                                        <input name="title1" type="text" class="form-control" id="form-password" placeholder="">
                                    </div>
                                    <div class="mb-4">
                                        <label for="form-password" class="form-label text-[.875rem] text-black">
                                            Project Name 2 {{app()->getLocale()}}</label>
                                        <input name="title2" type="text" class="form-control" id="form-password" placeholder="">
                                    </div>
                                    <div class="mb-4">
                                        <label for="form-password" class="form-label text-[.875rem] text-black">
                                            Order </label>
                                        <input name="order" type="text" class="form-control" id="form-password"  value="{{$project->position}}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="text-area" class="form-label">Project Description {{app()->getLocale()}}</label>
                                        <textarea name="projectdescription" class="form-control" id="text-area" rows="3"></textarea>
                                    </div>

                                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                                        <div>
                                            <label for="file-input" class="sr-only">Type file</label>
                                            <input type="file" name="projectimage[]" id="file-input" class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10
                                                 file:border-0
                                                file:bg-gray-200 file:me-4
                                                file:py-3 file:px-4
                                                dark:file:bg-black/20 dark:file:text-white/50">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-header justify-between">
                                    <div class="box-title">
                                        Add Features
                                    </div>
                                </div>
                                <div class="box-body" id="featuresdiv">


                                </div>
                                <div class="flex justify-center gap-6">
                                    <button id="addfeature" type="button"   class="ti-btn ti-btn-primary-full">Add Feature</button>
                                </div>


                                <div class="box-footer hidden border-t-0">
                                    <!-- Prism Code -->

                                    <!-- Prism Code -->
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="ti-modal-footer">
                    <button  class="hs-dropdown-toggle ti-btn ti-btn-secondary-full" data-hs-overlay="#hs-full-screen-modal">
                        Create
                    </button>
                </div>

                </form>
            </div>
        </div>
    </div>





    <form action="{{route('sendsms2')}}" method="post">
        @csrf
        <button>Send</button>
    </form>

    <div class="table-responsive">
        <table class="table whitespace-nowrap table-bordered table-bordered-primary border-primary/10 min-w-full">
            <thead>
            <tr class="border-b border-primary/10">
                <th scope="col" class="text-start">Project Image</th>
                <th scope="col" class="text-start">Title 1</th>
                <th scope="col" class="text-start">Title 2</th>
                <th scope="col" class="text-start">Description</th>
                <th scope="col" class="text-start">Features</th>
                <td>Position</td>

                <th scope="col" class="text-start">actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $index=> $project)
            <tr class="border-b border-primary/10">
              <td style="width: 200px">
                  @foreach($project->media as $img)
                      <img style="height: 200px;" src="{{asset($img->getUrl())}}" alt="">
                  @endforeach
              </td>
                <td>{{$project->title1}}</td>
                <td>{{$project->title2}}</td>
                <td>{{$project->description}}</td>
                <td>
                    @foreach($project->features as $feature)
                        <p>{{$feature->title}}</p>
                    @endforeach
                </td>
                <td>
                    {{$project->position}}
                </td>

<td>

    <a href="{{route('editProject', $project->id)}}" class="ti-btn ti-btn-danger-full">Edit</a>
    <form action="{{route('deleteProject')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$project->id}}">
        <button class="ti-btn ti-btn-danger-full">Delete Project</button>
    </form>
</td>
            </tr>


            @endforeach
            </tbody>
        </table>
    </div>

@endsection