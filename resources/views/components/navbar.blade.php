<nav class="bg-gray-800">
<x-navbar></x-navbar>

<header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-light text-gray-900">Home Page</h1>
</div>
</header>

<main>
<x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
<x-nav-link href="/blog" :active="request()->is('/blog')">Home</x-nav-link>
<x-nav-link href="/about" :active="request()->is('/about')">About</x-nav-link>
<x-nav-link href="/contact" :active="request()->is('/contact')">Contact</x-nav-link>

<a href="/blog"
class="{{ request()->is('blog') ? 'bg-gray-900 text-white' :
'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 p-2 text-sm font-medium">Blog</a>
<a href="/about"
class="{{ request()->is('about') ? 'bg-gray-900 text-white' :
'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 p-2 text-sm font-medium">About</a>
<a href="/contact"
class="{{ request()->is('contact') ? 'bg-gray-900 text-white' :
'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 p-2 text-sm font-medium">Contact</a>

</main>
</div>