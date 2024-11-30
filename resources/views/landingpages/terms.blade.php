@extends('landingcomponents.layout')

@section('terms')

    <section class="section-space-top section-space-md-bottom">
        <div style="display: flex;flex-direction: column;justify-content: center;align-items: center">
            <div class="d-inline-flex align-items-center flex-wrap row-gap-2 column-gap-4 mb-2" data-cue="fadeIn"
                 data-show="true"
                 style="animation-name: fadeIn; animation-duration: 500ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                <div class="flex-shrink-0 d-inline-block w-20 h-2px bg-primary-gradient"></div>
                <span class="d-block fw-medium text-light fs-20">FAQ</span>
                <div class="flex-shrink-0 d-inline-block w-20 h-2px bg-primary-gradient"></div>
            </div>
            <div class="col-lg-6">
                <div class="bg-dark-gradient p-6 p-xl-8 rounded-5">
                    <div class="accordion accordion--dark accordion-separate-body accordion--faq" id="faqAccordion"
                         data-cues="fadeIn" data-disabled="true">
                        <div class="accordion-item" data-cue="fadeIn" data-show="true"
                             style="animation-name: fadeIn; animation-duration: 500ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faqAccordion1" aria-expanded="true"
                                        aria-controls="faqAccordion1">
                                    ბალანსის შევსება
                                </button>
                            </h2>
                            <div id="faqAccordion1" class="accordion-collapse collapse show"
                                 data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-dark">Many desktop publishing packages and web
                                    page
                                    editors now uand a search for will uncover many web sites still in their
                                    infancy.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" data-cue="fadeIn" data-show="true"
                             style="animation-name: fadeIn; animation-duration: 500ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faqAccordion2" aria-expanded="false"
                                        aria-controls="faqAccordion2">თანხის დაბრუნება
                                </button>
                            </h2>
                            <div id="faqAccordion2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-dark">Many desktop publishing packages and web
                                    page
                                    editors now uand a search for will uncover many web sites still in their
                                    infancy.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" data-cue="fadeIn" data-show="true"
                             style="animation-name: fadeIn; animation-duration: 500ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faqAccordion3" aria-expanded="false"
                                        aria-controls="faqAccordion3">What Services Does Power Ai Provide?
                                </button>
                            </h2>
                            <div id="faqAccordion3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-dark">Many desktop publishing packages and web
                                    page
                                    editors now uand a search for will uncover many web sites still in their
                                    infancy.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" data-cue="fadeIn" data-show="true"
                             style="animation-name: fadeIn; animation-duration: 500ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faqAccordion4" aria-expanded="false"
                                        aria-controls="faqAccordion4">Is Power AI Suitable For Small Businesses?
                                </button>
                            </h2>
                            <div id="faqAccordion4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-dark">Many desktop publishing packages and web
                                    page
                                    editors now uand a search for will uncover many web sites still in their
                                    infancy.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
