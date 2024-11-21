@extends('admin.layout')

@php

//   dd(app()->getLocale());
 @endphp
@section('projects')

    <form action="{{route('updateProject')}}" method="post" enctype="multipart/form-data">
        @csrf
    <input type="hidden" name="id" value="{{$project->id}}">
        <div class="ti-modal-body">

            <div class="flex justify-center">
                <div class=" w-full">
                    <div class="">
                        <div class="box-header justify-between">
                            <div class="box-title">
                                update Project {{app()->getLocale()}}
                            </div>
                        </div>
                        <template id="featruresTemplate">
                            <div class="box-body" >
                                <div class="mb-4">
                                    <label for="form-password" class="form-label text-[.875rem] text-black">
                                        Feature Name</label>
                                    <input name="newfeturename[]" type="text" class="form-control" id="form-password" placeholder="">
                                </div>
                                <div class="mb-4">
                                    <label for="newfeaturedescription" class="form-label">Feature Description</label>
                                    <textarea name="newfeaturedescription[]" class="form-control"  rows="3"></textarea>
                                </div>
                                <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                                    <div>
                                        <label for="file-input" class="sr-only">Type file</label>

                                        <input type="file" name="newfeatureimage[]" id="file-input" class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10
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
                                <input name="title1" type="text" class="form-control" id="form-password" value="{{$project->title1}}">
                            </div>
                            <div class="mb-4">
                                <label for="form-password" class="form-label text-[.875rem] text-black">
                                    Project Name 2 {{app()->getLocale()}}</label>
                                <input name="title2" type="text" class="form-control" id="form-password"  value="{{$project->title2}}">
                            </div>
                            <div class="mb-4">
                                <label for="form-password" class="form-label text-[.875rem] text-black">
                                    Order </label>
                                <input name="order" type="text" class="form-control" id="form-password"  value="{{$project->position}}">
                            </div>

                            <div class="mb-4">
                                <label for="text-area" class="form-label">Project Description {{app()->getLocale()}}</label>
                                <textarea name="projectdescription" class="form-control" id="text-area" rows="3"> {{$project->description}}</textarea>
                            </div>

                            <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                                <div>
                                    <label for="file-input" class="sr-only">Type file</label>
                                    <input type="file" name="projectimage" id="file-input" class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10
                                                 file:border-0
                                                file:bg-gray-200 file:me-4
                                                file:py-3 file:px-4
                                                dark:file:bg-black/20 dark:file:text-white/50">
                                </div>
                            </div>
                        </div>
                        <div class="box-header justify-between">
                            <div class="box-title">
                                existing Features
                            </div>
                        </div>
                        <div class="box-body" id="oldfeatures">
                            @foreach($project->features as $feature)
                            <div class="box-body" >
                                <div class="mb-4">
                                    <input type="hidden" name="oldfeatureids[]" value="{{$feature->id}}" >
                                    <label for="form-password" class="form-label text-[.875rem] text-black">
                                        Feature Name</label>
                                    <input name="oldfeturename[]" type="text" class="form-control" id="form-password" value="{{$feature->title}}">
                                </div>
                                <div class="mb-4">
                                    <label for="featuredescription" class="form-label">Feature Description</label>
                                    <textarea name="oldfeaturedescription[]" class="form-control" id="featuredescription" rows="3">{{$feature->description}}</textarea>
                                </div>
                                <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                                    <div>
                                        <label for="file-input" class="sr-only">Type file</label>
                                        <input type="file" name="oldfeatureimage[]" id="file-input" class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10
                                                 file:border-0
                                                file:bg-gray-200 file:me-4
                                                file:py-3 file:px-4
                                                dark:file:bg-black/20 dark:file:text-white/50">
                                    </div>
                                </div>
                                <button type="button" class="removeButton">Remove</button>
                            </div>
                            @endforeach

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
        <div class="ti-modal-footer flex justify-center mt-7">
            <button  class="hs-dropdown-toggle ti-btn ti-btn-secondary-full" data-hs-overlay="#hs-full-screen-modal">
                update
            </button>
        </div>

    </form>





@endsection