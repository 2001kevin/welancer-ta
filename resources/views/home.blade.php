@extends('layouts.navbar')

@section('main')
    <section class="services py-14 px-32">
        <div class="flex flex-col items-center">
            <div class="text-center ">
                <h1 class="text-[40px] font-semibold">Services that lead the way to better business</h1>
                <p class="text-xs text-slate-400">Faucibus fringilla sed integer cursus tellus et, quis ultricies. Aliquam, faucibus arcu in laoreet ac elementum in eget. <br> Massa urna viverra vulputate euismod pulvinar nibh in vel. Laoreet blandit etiam orci est in vel lacus neque pretium.</p>
            </div>
            <div class="flex text-center pt-7">
                <div class="flex flex-col mx-5 items-center">
                    <div>
                        <img class="px-7 mb-3 w-[150px] height-[150px] " src="images/logo mobile app design.svg" alt="">
                    </div>
                    <p class="font-bold text-[#6854FC]">Mobile App Designing</p>
                    <p>Justo, amet nisl velit quam. Turpis <br> nulla morbi vestibulum morbi cum et. </p>
                </div>
                <div class="flex flex-col mx-5 items-center">
                    <div>
                        <img class="px-7 mb-3 w-[150px] height-[150px] " src="images/logo website design.svg" alt="">
                    </div>
                    <p class="font-bold text-[#6854FC]">Website Designing</p>
                    <p>Justo, amet nisl velit quam. Turpis <br> nulla morbi vestibulum morbi cum et. </p>
                </div>
            </div>
            <div class="flex text-center pt-7">
                <div class="flex flex-col mx-5 items-center">
                    <div>
                        <img class="px-7 mb-3 w-[150px] height-[150px] " src="images/graphic design.svg" alt="">
                    </div>
                    <p class="font-bold text-[#6854FC]">Graphic Desing</p>
                    <p>Justo, amet nisl velit quam. Turpis <br> nulla morbi vestibulum morbi cum et. </p>
                </div>
                <div class="flex flex-col mx-5 items-center">
                    <div>
                        <img class="px-7 mb-3 w-[150px] height-[150px] " src="images/Wedding organizer.svg" alt="">
                    </div>
                    <p class="font-bold text-[#6854FC]">Wedding Organizer</p>
                    <p>Justo, amet nisl velit quam. Turpis <br> nulla morbi vestibulum morbi cum et. </p>
                </div>
            </div>
        </div>
    </section>
    <section class="process">
        <div class="flex px-32 pt-12 pb-24">
            <img class="h-[595px] " src="images/process.png" alt="">
            <div class="flex flex-col ml-32">
                <h1 class="text-[40px] font-bold">Our Process</h1>
                <p class="text-slate-500">Sit arcu, egestas nunc, eros dignissim nunc, pretium malesuada. Tristique  est tellus non maecenas in egestas aliquam. Eget dolor pellentesque  consequat donec lectus nisl ligula. Ut sed nisi amet.</p>
                <div class="flex mt-8">
                    <img src="images/discovery.svg" alt="">
                    <div class="flex flex-col ml-5">
                        <p class=" font-semibold">Discovery</p>
                        <p class="text-[18px] text-slate-500">Velit lacus ipsum, urna, pretium lacinia. Mauris fermentum ut nunc est, nibh. Lectus eu vel et placerat sed velit morbi diam. Amet malesuada eget aliquam imperdiet. Arcu dolor sed pretiu</p>
                    </div>
                </div>
                <div class="flex mt-8">
                    <img src="images/plan.svg" alt="">
                    <div class="flex flex-col ml-5">
                        <p class=" font-semibold">Plan</p>
                        <p class="text-[18px] text-slate-500">Tellus, lacus, sem adipiscing ac sem amet. Vitae proin volutpat cras tempus vitae. Ipsum consectetur quis diam hendrerit pharetra amet scelerisque. Elementum risus aliquam quam etiam. Eget eu risus dui lacus, orci. Cras ultricies posuere adipiscing faucibu.</p>
                    </div>
                </div>
                <div class="flex mt-8">
                    <img src="images/execute.svg" alt="">
                    <div class="flex flex-col ml-5">
                        <p class=" font-semibold">Execute</p>
                        <p class="text-[18px] text-slate-500">Congue ridiculus at tortor mattis turpis bibendum at pulvinar viverra. Ultrices morbi amet quam nisl risus libero, sodales nibh faucibus. Sed gravida elementum auctor fermentum id sem</p>
                    </div>
                </div>
                <div class="flex mt-8">
                    <img src="images/deliver.svg" alt="">
                    <div class="flex flex-col ml-5">
                        <p class=" font-semibold">Deliver</p>
                        <p class="text-[18px] text-slate-500">Pellentesque id pharetra, semper neque purus. Ante lacinia in ut sagittis sed sapien. In facilisi in a diam. Pellentesque arcu faucibus vel ornare pulvinar sollicitudin eu. Tempus nisi malesuada convallis velit viverra odio. Senectus consectetur fames in sed velit, ornare. Sed arcu.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="our_work px-32 pb-24">
        <div class="text-center">
            <h1 class="text-[40px] font-bold">See Our Work</h1>
            <p class="text-[20px]">Interdum ac tincidunt molestie facilisis. Nulla at erat odio bibendum diam quam. Scelerisque mus vel <br> egestas justo, purus consequat nibh eget. Non risus feugiat porta integer.</p>
            <div class="flex justify-center gap-7 mt-7">
                <img src="images/Rectangle 21.png" alt="">
                <img src="images/Rectangle 22.png" alt="">
                <img src="images/Rectangle 23.png" alt="">
            </div>
            <div class="mt-10">
                <a class="py-2 px-6 bg-violet-700 rounded-xl text-white mt-5 font-semibold" href="">See All Project</a>
            </div>
        </div>
    </section>
    <section class="about_us mx-32 mb-24">
        <div class="flex justify-center items-center">
            <div>
                <img src="images/Rectangle 8.png" alt="">
            </div>
            <div class="content-center ml-32">
                <h1 class="text-[40px] font-bold">Designed and built by an <br> astonishing creative team.</h1>
                <p class="text-slate-500">Et eleifend consectetur tellus consectetur nibh non urna <br> lobortis. Quis sapien enim posuere mollis risus. Nec <br> dictumst ullamcorper et leo. Varius praesent tinc.</p>
                <div class="mt-8">
                    <a class="py-2 px-6 bg-violet-700 rounded-xl text-white font-semibold" href="">About Us</a>
                </div>
            </div>
        </div>
    </section>
    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
    <section class="review">
        <div class="mx-32">
            <div>
                <img src="images/review.png" alt="">
            </div>
            <div>

            </div>
        </div>
    </section>
@endsection
