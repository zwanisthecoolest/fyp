<!DOCTYPE html>
<html lang="en" style="scrollbar-gutter: stable;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Homepage</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative min-h-screen
             bg-[url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1950&q=80')]
             bg-cover
             bg-no-repeat
             bg-fixed
             bg-[position:center_10%]">
     <div class="container mx-auto px-6">
        <div class="bg-white/70 backdrop-blur-lg shadow-xl rounded-3xl px-6 py-6 flex justify-between items-center border border-gray-200">
              
            <!-- Logo -->
            <a href="{{ route('home') }}" 
               class="text-3xl font-extrabold text-gray-800 tracking-tight hover:text-indigo-600 transition duration-300">
                Hobby <span class="text-indigo-600 text">Blog</span>
            </a>

            <!-- Navigation -->
            <nav>
                <ul class="flex items-center space-x-8 text-sm font-medium">
                    
                    <li>
                        <a href="{{ route('about') }}" 
                           class="text-gray-600 hover:text-indigo-600 transition duration-300 relative group">
                            About Us
                            <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-indigo-600 transition-all group-hover:w-full"></span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('contact') }}" 
                           class="text-gray-600 hover:text-indigo-600 transition duration-300 relative group">
                            Contact
                            <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-indigo-600 transition-all group-hover:w-full"></span>
                        </a>
                    </li>

                </ul>
            </nav>

        </div>
    </div>
</header>
 
@yield('content')
 
</body>
</html>