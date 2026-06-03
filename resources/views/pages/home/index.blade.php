@extends('layouts.home')

@section('content')

<div class="antialiased">
    <div class="relative bg-gray-100 h-[500px] lg:h-[600px] overflow-hidden">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Luxury Home">
            <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/80 to-transparent"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex">
            <div class="max-w-2xl pt-4 md:pt-4">
                <h1 class="text-3xl lg:text-5xl font-extrabold text-blue-700 leading-tight mb-4">
                    รับฝากขายบ้าน-ที่ดิน-คอนโด<br>
                    <span class="text-3xl lg:text-4xl text-gray-800">และอสังหาริมทรัพย์ทุกประเภท</span><br>
                    <span class="inline-block bg-blue-700 text-white px-4 py-3 mt-2 rounded-sm text-sm lg:text-2xl">ในเขตกรุงเทพฯ และปริมณฑล</span>
                </h1>
                <p class="mt-4 text-gray-700 text-sm lg:text-base leading-relaxed max-w-lg">
                    บริษัท เบสท์แลนด์ แอนด์ เฮ้าส์ซิ่ง รับฝากขายบ้าน-ที่ดิน-คอนโด และอสังหาริมทรัพย์ทุกประเภท ในเขตกรุงเทพฯ และปริมณฑล ภายใต้แบรนด์ ERA แฟรนไชส์ของประเทศไทย ด้วยประสบการณ์เกือบ 30 ปี
                </p>

                <div class="grid grid-cols-2 gap-4 mt-2 md:mt-6">
                    <div class="flex items-center text-sm font-semibold text-blue-900">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center mr-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg></div>
                        ทีมงานมืออาชีพ
                    </div>
                    <div class="flex items-center text-sm font-semibold text-blue-900">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center mr-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg></div>
                        ทีมงานมืออาชีพ ดูแลครบวงจร
                    </div>
                    <div class="flex items-center text-sm font-semibold text-blue-900">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center mr-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg></div>
                        ขายง่ายเร็ว เก็บค่าคอม 3%
                    </div>
                    <div class="flex items-center text-sm font-semibold text-blue-900">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center mr-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path>
                            </svg></div>
                        ประสบการณ์กว่า 30 ปี
                    </div>
                </div>

                <div class="mt-4 mb-3">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 md:py-3 px-4 md:px-8 rounded-sm shadow-lg transition duration-300">
                        ปรึกษาฟรี! ไม่มีค่าใช้จ่าย
                    </button>
                    <p class="text-sm text-gray-600 mt-1 ml-1 md:ml-4">รับปรึกษา ทุกเรื่องอสังหาฯ ยินดีให้คำแนะนำ</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 mt-2 md:-mt-16 mb-16" x-data="{ tab: 'property' }">
        <div class="bg-white rounded-xl md:rounded-2xl shadow-xl p-3 md:p-6 border border-gray-100">

            <div class="flex space-x-3 md:space-x-6 border-b border-gray-200 mb-6">
                <button @click="tab = 'property'" :class="{ 'text-blue-700 border-blue-700 border-b-2 ': tab === 'property', 'text-gray-500 hover:text-blue-600': tab !== 'property' }" class="pb-3 flex items-center heading-font text-sm md:text-lg transition-colors">
                    <svg class="w-6 h-6 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    ค้นหาทรัพย์สิน
                </button>
                <button @click="tab = 'agent'" :class="{ 'text-blue-700 border-blue-700 border-b-2 ': tab === 'agent', 'text-gray-500 hover:text-blue-600': tab !== 'agent' }" class="pb-3 flex items-center heading-font text-sm md:text-lg transition-colors">
                    <svg class="w-6 h-6 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    ค้นหาตัวแทนขาย
                </button>
            </div>

            <div x-show="tab === 'property'" x-transition class="flex flex-col gap-4">
                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-3 pl-4" placeholder="ค้นหา (รหัสทรัพย์สิน, ชื่อหมู่บ้าน, ถนน, ทำเลหรือสถานที่)">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>หมวดหมู่ทรัพย์</option>
                        <option>ทั้งหมด</option>
                    </select>
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>จังหวัด</option>
                        <option>ทั้งหมด</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>เขต/อำเภอ</option>
                        <option>ทั้งหมด</option>
                    </select>
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>แขวง/ตำบล</option>
                        <option>ทั้งหมด</option>
                    </select>
                    <fieldset class="relative rounded-lg border border-gray-200 bg-linear-to-br from-gray-50 to-white px-3 pt-3.5 pb-2.5 min-w-0 sm:col-span-2 lg:col-span-1">
                        <legend class="absolute -top-2.5 left-2.5 bg-white px-1.5 text-[11px] font-semibold text-blue-700 tracking-wide">
                            ช่วงราคา
                        </legend>
                        <div class="grid grid-cols-[1fr_auto_1fr] items-center gap-2">
                            <div class="relative min-w-0">
                                <label for="price_min" class="sr-only">ราคาต่ำสุด</label>
                                <span class="pointer-events-none absolute left-2.5 top-1/2 -translate-y-1/2 text-xs font-medium text-gray-400" aria-hidden="true">฿</span>
                                <select id="price_min" name="price_min" class="w-full min-w-0 appearance-none rounded-md border border-gray-300 bg-white py-2.5 pr-7 pl-7 text-sm text-gray-900 shadow-sm transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                                    <option value="">ต่ำสุด</option>
                                    <option value="500000">500,000</option>
                                    <option value="1000000">1 ล้าน</option>
                                    <option value="2000000">2 ล้าน</option>
                                    <option value="3000000">3 ล้าน</option>
                                    <option value="5000000">5 ล้าน</option>
                                    <option value="10000000">10 ล้าน</option>
                                    <option value="20000000">20 ล้าน</option>
                                    <option value="50000000">50 ล้าน</option>
                                </select>
                                <svg class="pointer-events-none absolute right-2 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            <span class="text-[11px] font-medium text-gray-400 shrink-0">ถึง</span>
                            <div class="relative min-w-0">
                                <label for="price_max" class="sr-only">ราคาสูงสุด</label>
                                <span class="pointer-events-none absolute left-2.5 top-1/2 -translate-y-1/2 text-xs font-medium text-gray-400" aria-hidden="true">฿</span>
                                <select id="price_max" name="price_max" class="w-full min-w-0 appearance-none rounded-md border border-gray-300 bg-white py-2.5 pr-7 pl-7 text-sm text-gray-900 shadow-sm transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                                    <option value="">สูงสุด</option>
                                    <option value="1000000">1 ล้าน</option>
                                    <option value="2000000">2 ล้าน</option>
                                    <option value="3000000">3 ล้าน</option>
                                    <option value="5000000">5 ล้าน</option>
                                    <option value="10000000">10 ล้าน</option>
                                    <option value="20000000">20 ล้าน</option>
                                    <option value="50000000">50 ล้าน</option>
                                    <option value="100000000">100 ล้าน</option>
                                    <option value="unlimited">ไม่จำกัด</option>
                                </select>
                                <svg class="pointer-events-none absolute right-2 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="flex justify-center pt-2">
                    <button type="button" class="inline-flex items-center justify-center gap-2.5 rounded-lg bg-blue-700 px-12 py-3 text-base font-semibold text-white shadow-md transition hover:bg-blue-800 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span>ค้นหา</span>
                    </button>
                </div>
            </div>

            <div x-show="tab === 'agent'" x-transition style="display: none;">
                <div class="flex flex-col md:flex-row gap-4">
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-3 pl-4" placeholder="ชื่อตัวแทนขาย">
                    <button class="bg-blue-800 hover:bg-blue-900 text-white px-8 py-3 rounded-lg font-medium shadow w-full md:w-auto md:shrink-0 whitespace-nowrap">
                        ค้นหา
                    </button>
                </div>
            </div>

        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
        <h2 class="text-xl md:text-2xl font-bold text-center text-blue-800 mb-4">ประเภทอสังหาฯ</h2>
        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-4">
            <a href="#" class="group flex flex-col items-center">
                <div class="w-full aspect-square overflow-hidden rounded-xl border border-gray-200 mb-3 shadow-sm group-hover:shadow-md transition">
                    <img src="{{ asset('images/cover/house.webp') }}" alt="บ้านเดี่ยว/บ้านแฝด" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <h3 class="text-blue-800 font-semibold text-sm text-center">บ้านเดี่ยว/บ้านแฝด</h3>
            </a>
            <a href="#" class="group flex flex-col items-center">
                <div class="w-full aspect-square overflow-hidden rounded-xl border border-gray-200 mb-3 shadow-sm group-hover:shadow-md transition">
                    <img src="{{ asset('images/cover/townhome.webp') }}" alt="ทาวน์เฮ้าส์/ทาวน์โฮม" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <h3 class="text-blue-800 font-semibold text-sm text-center">ทาวน์เฮ้าส์/ทาวน์โฮม</h3>
            </a>
            <a href="#" class="group flex flex-col items-center">
                <div class="w-full aspect-square overflow-hidden rounded-xl border border-gray-200 mb-3 shadow-sm group-hover:shadow-md transition">
                    <img src="{{ asset('images/cover/condo.webp') }}" alt="คอนโดมิเนียม" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <h3 class="text-blue-800 font-semibold text-sm text-center">คอนโดมิเนียม</h3>
            </a>
            <a href="#" class="group flex flex-col items-center">
                <div class="w-full aspect-square overflow-hidden rounded-xl border border-gray-200 mb-3 shadow-sm group-hover:shadow-md transition">
                    <img src="{{ asset('images/cover/commercial-building.webp') }}" alt="ตึกแถว/อาคารพาณิชย์" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <h3 class="text-blue-800 font-semibold text-sm text-center">ตึกแถว/อาคารพาณิชย์</h3>
            </a>
            <a href="#" class="group flex flex-col items-center">
                <div class="w-full aspect-square overflow-hidden rounded-xl border border-gray-200 mb-3 shadow-sm group-hover:shadow-md transition">
                    <img src="{{ asset('images/cover/land.webp') }}" alt="ที่ดินเปล่า" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <h3 class="text-blue-800 font-semibold text-sm text-center">ที่ดินเปล่า</h3>
            </a>
            <a href="#" class="group flex flex-col items-center">
                <div class="w-full aspect-square overflow-hidden rounded-xl border border-gray-200 mb-3 shadow-sm group-hover:shadow-md transition">
                    <img src="{{ asset('images/cover/warehouse.webp') }}" alt="โกดัง/โรงงาน" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <h3 class="text-blue-800 font-semibold text-sm text-center">โกดัง/โรงงาน</h3>
            </a>
            <a href="#" class="group flex flex-col items-center">
                <div class="w-full aspect-square overflow-hidden rounded-xl border border-gray-200 mb-3 shadow-sm group-hover:shadow-md transition">
                    <img src="{{ asset('images/cover/apartment.webp') }}" alt="อพาร์ทเมนต์/หอพัก อื่นๆ" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <h3 class="text-blue-800 font-semibold text-sm text-center">อพาร์ทเมนต์/หอพัก<br>อื่นๆ</h3>
            </a>
        </div>
    </div>

    <div class="bg-blue-50/50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div class="bg-white rounded-3xl p-4 md:p-8 shadow-sm border border-blue-100">
                    <h3 class="text-xl md:text-2xl font-bold text-blue-800 text-center mb-4 md:mb-8">ข้อดีในการฝากขายกับทางบริษัทเรา</h3>
                    <ul class="space-y-6">
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-800 text-white flex items-center justify-center font-bold mt-1">1</div>
                            <p class="ml-4 text-blue-900 font-medium">บริษัทเรามีประสบการณ์ในการขายมากกว่า 30 ปี<br><span class="text-sm font-normal text-gray-600">มีที่อยู่อาศัยสามารถตรวจสอบได้</span></p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-800 text-white flex items-center justify-center font-bold mt-1">2</div>
                            <p class="ml-4 text-blue-900 font-medium">มีโฆษณาประชาสัมพันธ์ในสื่อออนไลน์ทุกแพลตฟอร์ม<br><span class="text-sm font-normal text-gray-600">คนมองเห็นประกาศของเรากว่า 700,000 คนต่อเดือน<br>และจะเพิ่มขึ้นเรื่อยๆ ทุกวัน</span></p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-800 text-white flex items-center justify-center font-bold mt-1">3</div>
                            <p class="ml-4 text-blue-900 font-medium">เรามีการให้คำปรึกษาเรื่องการตั้งราคาขายที่เหมาะสม(ราคาตลาด)<br><span class="text-sm font-normal text-gray-600">สามารถขายได้ไวและได้ราคา</span></p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-800 text-white flex items-center justify-center font-bold mt-1">4</div>
                            <p class="ml-4 text-blue-900 font-medium">และยังมีผู้ซื้อรอคิวซื้อทรัพย์ของท่านมากกว่า 3,000 ราย<br><span class="text-sm font-normal text-gray-600">และจะเพิ่มขึ้นเรื่อยๆ ทุกวัน</span></p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-800 text-white flex items-center justify-center font-bold mt-1">5</div>
                            <p class="ml-4 text-blue-900 font-medium">ในกรณีที่ผู้ซื้อค้นหาทรัพย์ที่อยู่ในบริเวณนั้น ก็จะเจอทรัพย์ของท่าน<br><span class="text-sm font-normal text-gray-600">อยู่ในหน้ารายการของ Google</span></p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-800 text-white flex items-center justify-center font-bold mt-1">6</div>
                            <p class="ml-4 text-blue-900 font-medium">เบื้องต้นท่านยังไม่ต้องเสียค่าใช้จ่ายแต่อย่างใด (ฟรี!)<br><span class="text-sm font-normal text-gray-600">จนกว่าจะขายได้ ขายได้คิด 3% จากราคาคำนวณได้<br>(นโยบายไม่มีบวกราคาเพิ่มของค่าคอมนะคะ)</span></p>
                        </li>
                    </ul>
                </div>

                <div class="bg-blue-600 rounded-xl p-1 shadow-lg overflow-hidden flex flex-col">

                    <div class="relative flex-grow aspect-video bg-black rounded-b-2xl overflow-hidden">
                        <iframe class="absolute inset-0 h-full w-full" src="https://www.youtube.com/embed/uwaVZ6KMrno?start=1" title="VDO: ข้อดีในการฝากขายกับทางบริษัท" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl p-6 border border-gray-200 flex items-center shadow-sm">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex-shrink-0 flex items-center justify-center mr-4">
                    <img src="{{ asset('images/treasury.png') }}" alt="Appraisal" class="w-10 h-10">
                </div>
                <div>
                    <h4 class="font-bold text-blue-900">ค้นหาราคาประเมิน<br>(กรมธนารักษ์)</h4>
                    <a href="https://assessprice.treasury.go.th/" target="_blank" class="mt-2 bg-blue-600 text-white text-xs px-4 py-1.5 rounded hover:bg-blue-700">เข้าสู่เว็บไซต์</a>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-200 flex items-center shadow-sm">
                <div class="w-16 h-16 bg-gray-800 rounded-full flex-shrink-0 flex items-center justify-center mr-4">
                    <img src="{{ asset('images/lands-logo.jpg') }}" alt="LandsMaps" class="w-10 h-10">
                </div>
                <div>
                    <h4 class="font-bold text-blue-900">ค้นหาตำแหน่งแปลงที่ดิน<br>(LandsMaps)</h4>
                    <a href="https://lands.maps.go.th/" target="_blank" class="mt-2 bg-blue-600 text-white text-xs px-4 py-1.5 rounded hover:bg-blue-700">เข้าสู่เว็บไซต์</a>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-200 flex items-center shadow-sm">
                <div class="w-16 h-16 bg-green-100 rounded-full flex-shrink-0 flex items-center justify-center mr-4">
                    <img src="https://placehold.co/50x50/transparent/15803d?text=DOL" alt="DOL" class="w-10 h-10">
                </div>
                <div>
                    <h4 class="font-bold text-blue-900">กรมที่ดิน (DOL)</h4>
                    <button class="mt-2 bg-blue-600 text-white text-xs px-4 py-1.5 rounded hover:bg-blue-700">เข้าสู่เว็บไซต์</button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
        <h3 class="text-2xl font-bold text-center text-blue-800 mb-8">ดาวน์โหลดเอกสารสำคัญ</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl p-6 border border-gray-200 flex items-center shadow-sm justify-between">
                <div class="flex items-center">
                    <img src="https://placehold.co/40x50/white/ef4444?text=PDF" alt="PDF" class="w-10 mr-4">
                    <h4 class="font-bold text-blue-900 text-sm">สัญญาแต่งตั้งตัวแทนขาย</h4>
                </div>
                <button class="bg-blue-600 text-white text-xs px-4 py-2 rounded hover:bg-blue-700">ดาวน์โหลด</button>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-200 flex items-center shadow-sm justify-between">
                <div class="flex items-center">
                    <img src="https://placehold.co/40x50/white/ef4444?text=PDF" alt="PDF" class="w-10 mr-4">
                    <h4 class="font-bold text-blue-900 text-sm">สัญญาจะซื้อจะขาย</h4>
                </div>
                <button class="bg-blue-600 text-white text-xs px-4 py-2 rounded hover:bg-blue-700">ดาวน์โหลด</button>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-200 flex items-center shadow-sm justify-between">
                <div class="flex items-center">
                    <img src="https://placehold.co/50x50/transparent/ef4444?text=Map" alt="Map" class="w-10 mr-4">
                    <h4 class="font-bold text-blue-900 text-sm">ที่ตั้งของบริษัท</h4>
                </div>
                <button class="bg-blue-600 text-white text-xs px-4 py-2 rounded hover:bg-blue-700">ดูแผนที่</button>
            </div>
        </div>
    </div>


</div>

@endsection
