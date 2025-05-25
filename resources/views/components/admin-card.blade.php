<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Card Siswa -->
    <div class="group relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
        data-category="students">
        <div
            class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0">
        </div>
        <div class="p-6 flex items-center justify-between relative z-10">
            <div class="transition-all duration-300 group-hover:translate-x-2">
                <div class="text-blue-500 group-hover:text-white text-sm font-medium transition-colors duration-300">
                    Total Siswa</div>
                <div class="mt-2 flex items-baseline">
                    <h3
                        class="text-2xl font-bold text-gray-900 dark:text-white group-hover:text-white transition-colors duration-300">
                        {{ $totalStudents }}</h3>
                    <span
                        class="ml-2 text-xs font-medium text-green-500 group-hover:text-green-200 transition-colors duration-300">+5.2%</span>
                </div>
            </div>
            <div class="bg-blue-100 group-hover:bg-white/20 p-3 rounded-xl transition-colors duration-300">
                <x-icons.users height="h-8" width="w-8"
                    class="text-blue-500 group-hover:text-white transition-colors duration-300" />
            </div>
        </div>
        <div class="h-1 bg-gradient-to-r from-blue-300 to-blue-600 w-0 group-hover:w-full transition-all duration-500">
        </div>
    </div>

    <!-- Card Guru -->
    <div class="group relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
        data-category="teachers">
        <div
            class="absolute inset-0 bg-gradient-to-br from-purple-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0">
        </div>
        <div class="p-6 flex items-center justify-between relative z-10">
            <div class="transition-all duration-300 group-hover:translate-x-2">
                <div class="text-purple-500 group-hover:text-white text-sm font-medium transition-colors duration-300">
                    Total Guru</div>
                <div class="mt-2 flex items-baseline">
                    <h3
                        class="text-2xl font-bold text-gray-900 dark:text-white group-hover:text-white transition-colors duration-300">
                        {{ $totalTeachers }}</h3>
                    <span
                        class="ml-2 text-xs font-medium text-green-500 group-hover:text-green-200 transition-colors duration-300">+1.8%</span>
                </div>
            </div>
            <div class="bg-purple-100 group-hover:bg-white/20 p-3 rounded-xl transition-colors duration-300">
                <x-icons.user class="h-8 w-8 text-purple-500 group-hover:text-white transition-colors duration-300" />
            </div>
        </div>
        <div
            class="h-1 bg-gradient-to-r from-purple-300 to-purple-600 w-0 group-hover:w-full transition-all duration-500">
        </div>
    </div>

    <!-- Card Kelas -->
    <div class="group relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
        data-category="classes">
        <div
            class="absolute inset-0 bg-gradient-to-br from-amber-500 to-amber-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0">
        </div>
        <div class="p-6 flex items-center justify-between relative z-10">
            <div class="transition-all duration-300 group-hover:translate-x-2">
                <div class="text-amber-500 group-hover:text-white text-sm font-medium transition-colors duration-300">
                    Total Kelas</div>
                <div class="mt-2 flex items-baseline">
                    <h3
                        class="text-2xl font-bold text-gray-900 dark:text-white group-hover:text-white transition-colors duration-300">
                        {{ $totalClasses }}</h3>
                    <span
                        class="ml-2 text-xs font-medium text-green-500 group-hover:text-green-200 transition-colors duration-300">+2.3%</span>
                </div>
            </div>
            <div class="bg-amber-100 group-hover:bg-white/20 p-3 rounded-xl transition-colors duration-300">
                <x-icons.apartment
                    class="h-8 w-8 text-amber-500 group-hover:text-white transition-colors duration-300" />
            </div>
        </div>
        <div
            class="h-1 bg-gradient-to-r from-amber-300 to-amber-600 w-0 group-hover:w-full transition-all duration-500">
        </div>
    </div>

    <!-- Card Mata Pelajaran -->
    <div class="group relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
        data-category="subjects">
        <div
            class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0">
        </div>
        <div class="p-6 flex items-center justify-between relative z-10">
            <div class="transition-all duration-300 group-hover:translate-x-2">
                <div class="text-emerald-500 group-hover:text-white text-sm font-medium transition-colors duration-300">
                    Mata Pelajaran</div>
                <div class="mt-2 flex items-baseline">
                    <h3
                        class="text-2xl font-bold text-gray-900 dark:text-white group-hover:text-white transition-colors duration-300">
                        {{ $totalSubjects }}</h3>
                    <span
                        class="ml-2 text-xs font-medium text-green-500 group-hover:text-green-200 transition-colors duration-300">+0.5%</span>
                </div>
            </div>
            <div class="bg-emerald-100 group-hover:bg-white/20 p-3 rounded-xl transition-colors duration-300">
                <x-icons.books class="h-8 w-8 text-emerald-500 group-hover:text-white transition-colors duration-300" />
            </div>
        </div>
        <div
            class="h-1 bg-gradient-to-r from-emerald-300 to-emerald-600 w-0 group-hover:w-full transition-all duration-500">
        </div>
    </div>
</div>
