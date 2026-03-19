<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تسجيل الدخول</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');
        body {
            font-family: 'Tajawal', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-100 to-purple-100 min-h-screen font-sans antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
        <!-- بطاقة تسجيل الدخول -->
        <div class="w-full sm:max-w-md" x-data="{ showPassword: false }">
            <!-- الشعار أو الأيقونة -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white/90 backdrop-blur-sm shadow-xl overflow-hidden sm:rounded-2xl p-8">
                <h2 class="text-center text-3xl font-bold text-gray-800 mb-2">مرحباً بعودتك</h2>
                <p class="text-center text-gray-600 mb-8">يرجى إدخال بيانات الدخول</p>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-r-4 border-red-500 p-4 rounded-lg" role="alert">
                        <div class="flex">
                            <div class="ml-3">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-red-800">حدث خطأ في تسجيل الدخول</h3>
                                <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- البريد الإلكتروني -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 ml-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                البريد الإلكتروني
                            </span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200 outline-none text-right"
                            placeholder="example@domain.com"
                            dir="ltr">
                    </div>

                    <!-- كلمة المرور -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 ml-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                كلمة المرور
                            </span>
                        </label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" 
                                name="password" 
                                required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200 outline-none pl-12 text-right"
                                placeholder="********">
                            <button type="button" 
                                @click="showPassword = !showPassword"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- تذكرني ونسيت كلمة المرور -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 ml-2">
                            <span class="text-sm text-gray-600">تذكرني</span>
                        </label>
                        {{-- <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline transition">
                            نسيت كلمة المرور؟
                        </a> --}}
                    </div>

                    <!-- زر تسجيل الدخول -->
                    <div>
                        <button type="submit" 
                            class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition duration-200 flex items-center justify-center space-x-2 space-x-reverse">
                            <span>تسجيل الدخول</span>
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- رابط التسجيل -->
                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600">
                            ليس لديك حساب؟ 
                            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 hover:underline font-medium">
                                إنشاء حساب جديد
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- حقوق الملكية -->
            <div class="text-center mt-8 text-sm text-gray-600">
                &copy; {{ date('Y') }} جميع الحقوق محفوظة
            </div>
        </div>
    </div>
</body>
</html>