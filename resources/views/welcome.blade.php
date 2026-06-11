<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SEO --}}
    <title>Exequiel Lustan — Laravel Developer & AI-Assisted Programmer</title>
    <meta name="description" content="Exequiel Lustan is a full-stack developer specializing in Laravel, Livewire, Filament, and AI-assisted programming. Available for hire — let's build something great together.">
    <meta name="keywords" content="full-stack developer, Laravel developer, Livewire, Filament, PHP, TailwindCSS, AlpineJS, AI-assisted programming, portfolio, hire developer, Philippines">
    <meta name="author" content="Exequiel Lustan">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/') }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Exequiel Lustan — Laravel Developer & AI-Assisted Programmer">
    <meta property="og:description" content="Full-stack developer specializing in Laravel, Livewire, Filament, and AI-assisted programming. Let's build something great.">
    <meta property="og:image" content="{{ asset('assets/illustrations/portfolio.jpg') }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Exequiel Lustan — Laravel Developer">
    <meta name="twitter:description" content="Full-stack developer specializing in Laravel, Livewire, Filament, and AI-assisted programming.">
    <meta name="twitter:image" content="{{ asset('assets/illustrations/portfolio.jpg') }}">

    {{-- Favicons --}}
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet">

    {{-- Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
    @livewireStyles

    <style>
        html { scroll-behavior: smooth; }
        .section-fade { opacity: 0; transform: translateY(18px); transition: opacity .7s ease, transform .7s ease; }
        .section-fade.visible { opacity: 1; transform: none; }
        .gradient-text {
            background: linear-gradient(135deg, #B91C1C 0%, #0F766E 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .ai-badge { background: linear-gradient(135deg, #B91C1C 0%, #0F766E 100%); }
        .card-hover { transition: transform .25s ease, border-color .25s ease, box-shadow .25s ease; }
        .card-hover:hover { transform: translateY(-3px); border-color: rgba(185, 28, 28, .26); box-shadow: 0 22px 55px rgba(24,24,27,.08); }
        .skill-tag { transition: all .2s ease; }
        .skill-tag:hover { border-style: solid; transform: translateY(-2px); }
        .nav-link { position: relative; }
        .nav-link::after { content:''; position:absolute; bottom:-2px; left:0; width:0; height:2px; background:#B91C1C; transition: width .3s ease; }
        .nav-link:hover::after { width:100%; }
        .section-kicker { letter-spacing: .16em; }
        .photo-lift { box-shadow: 0 24px 70px rgba(24, 24, 27, .14); }

        /* ── macOS-style modal animations ──────────────────────────────────── */
        @keyframes modal-backdrop-in  { from { opacity: 0; } to { opacity: 1; } }
        @keyframes modal-backdrop-out { from { opacity: 1; } to { opacity: 0; } }
        @keyframes modal-panel-in {
            from { opacity: 0; transform: scale(0.94) translateY(6px); }
            to   { opacity: 1; transform: scale(1)    translateY(0);   }
        }
        @keyframes modal-panel-out {
            from { opacity: 1; transform: scale(1)    translateY(0);   }
            to   { opacity: 0; transform: scale(0.94) translateY(6px); }
        }
        .modal-backdrop-enter { animation: modal-backdrop-in  220ms cubic-bezier(0.32,0.72,0,1) forwards; }
        .modal-backdrop-leave { animation: modal-backdrop-out 180ms cubic-bezier(0.32,0.72,0,1) forwards; }
        .modal-panel-enter    { animation: modal-panel-in     260ms cubic-bezier(0.34,1.56,0.64,1) forwards; }
        .modal-panel-leave    { animation: modal-panel-out    180ms cubic-bezier(0.32,0.72,0,1)    forwards; }
    </style>
</head>

@php
    $backendSkills  = ['PHP', 'Laravel', 'Filament', 'MySQL', 'PostgreSQL', 'Redis', 'REST APIs', 'Authentication', 'Testing (Pest)', 'Git & DevOps'];
    $frontendSkills = ['HTML5', 'CSS3', 'JavaScript', 'Blade Templates', 'Tailwind CSS', 'Livewire', 'Alpine.js', 'Responsive Design', 'Performance', 'UI/UX Principles'];

    $aiSkills = [
        ['title' => 'AI-Assisted Programming',  'desc' => 'Using Claude, ChatGPT, and GitHub Copilot as careful support for exploration, review, and implementation details.'],
        ['title' => 'Prompt Design',             'desc' => 'Writing clear technical instructions, constraints, examples, and acceptance criteria so tooling produces useful drafts.'],
        ['title' => 'Workflow Integration',      'desc' => 'Applying AI where it helps without skipping design judgment, code review, testing, or maintainability checks.'],
        ['title' => 'LLM API Usage',             'desc' => 'Building practical LLM-backed features with context handling, function calling, and response streaming.'],
    ];

    $checkUrl = function (string $url): string {
        $key = 'project_status_' . md5($url);
        return \Illuminate\Support\Facades\Cache::remember($key, now()->addMinutes(5), function () use ($url): string {
            try {
                $response = \Illuminate\Support\Facades\Http::timeout(5)->withoutVerifying()->head($url);
                return $response->successful() || $response->redirect() ? 'Live' : 'Down';
            } catch (\Throwable) {
                return 'Down';
            }
        });
    };

    $projects = [
        [
            'title'  => 'IBU — Integrated Bicol University Portal',
            'url'    => 'https://ibu.bicol-u.edu.ph',
            'tags'   => ['Laravel', 'MySQL', 'Blade', 'Tailwind CSS', 'Livewire', 'AlpineJS','Filament'],
            'desc'   => 'A centralized university portal serving as the digital gateway for Bicol University — consolidating academic resources, announcements, and institutional services into a single unified platform.',
            'year'   => '2025',
            'status' => $checkUrl('https://ibu.bicol-u.edu.ph'),
        ],
        [
            'title'  => 'ICTO — Content Management & Service Request System',
            'url'    => 'https://icto.bicol-u.edu.ph',
            'tags'   => ['Laravel', 'Livewire', 'MySQL', 'Tailwind CSS','Filament','AlpineJS'],
            'desc'   => 'A dual-purpose platform for the BU ICT Office — featuring a full CMS for managing web content and an integrated service request system that streamlines IT support ticketing and request tracking across offices.',
            'year'   => '2024',
            'status' => $checkUrl('https://icto.bicol-u.edu.ph'),
        ],
        [
            'title'  => 'Survey — Clientele Satisfaction System',
            'url'    => 'https://survey.bicol-u.edu.ph',
            'tags'   => ['Laravel', 'Bootstrap 5', 'MySQL', 'Chart.js', 'Livewire','Filament'],
            'desc'   => 'An online survey platform that measures clientele satisfaction across all university offices. Supports configurable questionnaires per office, real-time response analytics, and exportable reports for quality assurance.',
            'year'   => '2023',
            'status' => $checkUrl('https://survey.bicol-u.edu.ph'),
        ],
        [
            'title'  => 'GASS — Financial Monitoring & Claims System',
            'url'    => 'https://gass.bicol-u.edu.ph',
            'tags'   => ['Laravel', 'MySQL', 'Livewire', 'Alpine.js','Filament'],
            'desc'   => 'A financial monitoring system for the General Administrative & Support Services office — automating claims processing, budget tracking, expenditure monitoring, and generating financial compliance reports.',
            'year'   => '2022',
            'status' => $checkUrl('https://gass.bicol-u.edu.ph'),
        ],
    ];

    $githubHighlights = [
        'Enterprise university systems',
        'SaaS products',
        'Automation and AI tools',
        'Open-source Laravel packages',
    ];

    $packageFeatures = [
        'Turns Eloquent or Query Builder chains into serializable Signal objects',
        'Built for Livewire 3/4 hydration and Alpine.js handoff',
        'Keeps count, first, pluck, data, and pagination metadata together',
        'Supports Laravel 11, 12, and 13 with PHP 8.2+',
    ];

    $deploymentPlatforms = [
        [
            'name'    => 'Hostinger',
            'label'   => 'VPS & Shared Hosting',
            'desc'    => 'Deploying Laravel applications on Hostinger VPS and shared hosting — managing hPanel, SSH access, configuring PHP versions, setting up MySQL databases, SSL certificates, and running Artisan commands.',
            'badges'  => ['hPanel', 'VPS', 'SSH', 'PHP-FPM', 'MySQL', 'SSL/TLS'],
            'color'   => 'text-[#673DE6]',
            'bg'      => 'bg-[#673DE6]/10',
            'current' => true,
            'icon'    => '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125"/></svg>', // Heroicons: circle-stack
        ],
        [
            'name'    => 'AWS EC2',
            'label'   => 'Amazon Web Services',
            'desc'    => 'Provisioning and managing EC2 instances for production Laravel apps — configuring Nginx, SSL via Certbot, environment setup, and process management with Supervisor for queue workers.',
            'badges'  => ['EC2', 'Nginx', 'SSL/TLS', 'Ubuntu', 'Supervisor', 'Cron Jobs'],
            'color'   => 'text-[#FF9900]',
            'bg'      => 'bg-[#FF9900]/10',
            'current' => false,
            'icon'    => '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"/></svg>', // Heroicons: cpu-chip
        ],
        [
            'name'    => 'SiteGround',
            'label'   => 'Managed Cloud Hosting',
            'desc'    => 'Deploying Laravel applications on SiteGround\'s managed hosting — configuring cPanel, setting up SSH access, managing .env files, running Artisan commands, and configuring cron jobs via cPanel scheduler.',
            'badges'  => ['cPanel', 'SSH', 'PHP-FPM', 'MySQL', 'Let\'s Encrypt', 'Composer'],
            'color'   => 'text-[#B91C1C]',
            'bg'      => 'bg-[#B91C1C]/10',
            'current' => false,
            'icon'    => '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.893 13.393l-1.135-1.135a2.252 2.252 0 0 1-.421-.585l-1.08-2.16a.414.414 0 0 0-.663-.107.827.827 0 0 1-.812.21l-1.273-.363a.89.89 0 0 0-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 0 1-1.81 1.025 1.055 1.055 0 0 1-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 0 1-1.383-2.46l.007-.042a2.25 2.25 0 0 1 .29-.787l.09-.15a2.25 2.25 0 0 1 2.37-1.048l1.178.236a1.125 1.125 0 0 0 1.302-.795l.208-.73a1.125 1.125 0 0 0-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 0 1-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 0 1-1.458-1.137l1.411-2.353a2.25 2.25 0 0 0 .286-.76m11.928 9.869A9 9 0 0 0 8.965 3.525m11.928 9.868A9 9 0 1 1 8.965 3.525"/></svg>', // Heroicons: globe-americas
        ],
        [
            'name'    => 'Laravel Cloud',
            'label'   => 'Laravel Native Platform',
            'desc'    => 'Deploying and scaling Laravel applications on Laravel Cloud — leveraging zero-downtime deployments, environment management, automatic scaling, and built-in queue/scheduler support for production-grade workloads.',
            'badges'  => ['Zero-Downtime', 'Auto-Scaling', 'Queues', 'Scheduler', 'Environment Mgmt'],
            'color'   => 'text-[#FF2D20]',
            'bg'      => 'bg-[#FF2D20]/10',
            'current' => false,
            'icon'    => '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z"/></svg>', // Heroicons: cloud-arrow-up
        ],
    ];

    $tags = ['Motivated', 'Creative', 'Problem Solver', 'Team Player', 'Adaptable', 'Passionate', 'Detail-Oriented', 'Continuous Learner'];

    $conferencePhotos = [
        [
            'src' => 'assets/conferences/696479322_1565802294968111_4488256334593409955_n.jpg',
            'alt' => 'Exequiel Lustan attending Laravel Live Japan conference',
            'class' => 'md:col-span-2 md:row-span-2',
        ],
        [
            'src' => 'assets/conferences/695853118_2186083152188094_5374408375521181971_n.jpg',
            'alt' => 'Laravel Live Japan conference moment',
            'class' => '',
        ],
        [
            'src' => 'assets/conferences/706002627_927630927029087_3992103225178855094_n.jpg',
            'alt' => 'First Laravel Live conference experience in Japan',
            'class' => '',
        ],
        [
            'src' => 'assets/conferences/708500936_1636224477446696_9021900587874232122_n.jpg',
            'alt' => 'Laravel community gathering in Japan',
            'class' => 'md:col-span-2',
        ],
    ];
@endphp

<body class="bg-[#f6f7f2] dark:bg-[#0b0c0c] text-[#18181b] dark:text-white font-sans antialiased">

    {{-- ── Navigation ──────────────────────────────────────────────────────── --}}
    <header class="fixed top-0 left-0 right-0 z-50 bg-[#f6f7f2]/86 dark:bg-[#0b0c0c]/86 backdrop-blur-md border-b border-zinc-900/5 dark:border-white/10">
        <nav class="max-w-7xl mx-auto px-6 md:px-10 py-5 flex items-center justify-between">
            <a href="#hero" class="flex items-center">
                <img src="{{ asset('logo.svg') }}" alt="EL." class="h-8 w-auto" width="96" height="40">
            </a>
            <ul class="hidden lg:flex items-center gap-7 text-sm font-medium text-zinc-600 dark:text-zinc-400">
                <li><a href="#about"    class="nav-link hover:text-[#B91C1C] transition">About</a></li>
                <li><a href="#conference" class="nav-link hover:text-[#B91C1C] transition">Japan</a></li>
                <li><a href="#ai"       class="nav-link hover:text-[#B91C1C] transition">Workflow</a></li>
                <li><a href="#skills"   class="nav-link hover:text-[#B91C1C] transition">Skills</a></li>
                <li><a href="#deployment" class="nav-link hover:text-[#B91C1C] transition">Deployment</a></li>
                <li><a href="#projects"  class="nav-link hover:text-[#B91C1C] transition">Projects</a></li>
                <li><a href="#opensource" class="nav-link hover:text-[#B91C1C] transition">Open Source</a></li>
                <li><a href="#contact"   class="nav-link hover:text-[#B91C1C] transition">Contact</a></li>
            </ul>
            <a href="#contact"
               class="hidden md:inline-flex items-center gap-2 bg-[#18181b] text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-[#B91C1C] transition">
                Hire Me
            </a>
            {{-- Mobile menu toggle --}}
            <button id="menu-toggle" class="lg:hidden text-zinc-600 dark:text-zinc-400 focus:outline-none" aria-label="Toggle menu">
                {{-- Heroicons: bars-3 --}}
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>
        </nav>
        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden lg:hidden border-t border-zinc-900/5 dark:border-white/10 bg-[#f6f7f2] dark:bg-[#0b0c0c] px-6 py-5 space-y-4 text-sm font-medium">
            <a href="#about"    class="block hover:text-[#B91C1C] transition" onclick="document.getElementById('mobile-menu').classList.add('hidden')">About</a>
            <a href="#conference" class="block hover:text-[#B91C1C] transition" onclick="document.getElementById('mobile-menu').classList.add('hidden')">Japan</a>
            <a href="#ai"       class="block hover:text-[#B91C1C] transition" onclick="document.getElementById('mobile-menu').classList.add('hidden')">Workflow</a>
            <a href="#skills"   class="block hover:text-[#B91C1C] transition" onclick="document.getElementById('mobile-menu').classList.add('hidden')">Skills</a>
            <a href="#deployment" class="block hover:text-[#B91C1C] transition" onclick="document.getElementById('mobile-menu').classList.add('hidden')">Deployment</a>
            <a href="#projects"   class="block hover:text-[#B91C1C] transition" onclick="document.getElementById('mobile-menu').classList.add('hidden')">Projects</a>
            <a href="#opensource" class="block hover:text-[#B91C1C] transition" onclick="document.getElementById('mobile-menu').classList.add('hidden')">Open Source</a>
            <a href="#contact"    class="block hover:text-[#B91C1C] transition" onclick="document.getElementById('mobile-menu').classList.add('hidden')">Contact</a>
        </div>
    </header>

    {{-- ── Hero ─────────────────────────────────────────────────────────────── --}}
    <section id="hero" class="min-h-[92vh] flex items-center pt-24">
        <div class="max-w-7xl mx-auto px-6 md:px-10 py-24 lg:py-32 w-full">
            <div class="grid lg:grid-cols-[1.05fr_.95fr] gap-16 lg:gap-24 items-center">
                {{-- Text --}}
                <div class="space-y-10 section-fade">
                    <div class="space-y-6">
                        <p class="section-kicker text-sm font-semibold text-zinc-500 dark:text-zinc-400 uppercase">
                            Full-Stack Developer
                        </p>
                        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold leading-[1.02]">
                            Hi, I'm <span class="gradient-text">Exequiel<br>Lustan</span>
                        </h1>
                        <p class="text-lg md:text-xl text-zinc-600 dark:text-zinc-300 max-w-2xl leading-8">
                            I craft <strong class="text-[#1b1b18] dark:text-white">elegant web applications</strong> with a focus on clean code, performance, and interfaces that feel considered from the first click.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="#projects"
                           class="inline-flex items-center gap-2 bg-[#18181b] text-white font-semibold px-6 py-3 rounded-lg hover:bg-[#B91C1C] transition-all duration-200 shadow-lg shadow-zinc-900/15">
                            View My Work
                            {{-- Heroicons: arrow-right --}}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                        <a href="#contact"
                           class="inline-flex items-center gap-2 border border-zinc-900/10 dark:border-white/10 bg-white/50 dark:bg-white/5 text-[#1b1b18] dark:text-white font-semibold px-6 py-3 rounded-lg hover:border-[#B91C1C] hover:text-[#B91C1C] transition-all duration-200">
                            Let's Talk
                        </a>
                        <button onclick="openResume()"
                                class="inline-flex items-center gap-2 border border-zinc-900/10 dark:border-white/10 bg-white/50 dark:bg-white/5 text-[#1b1b18] dark:text-white font-semibold px-6 py-3 rounded-lg hover:border-[#B91C1C] hover:text-[#B91C1C] transition-all duration-200">
                            {{-- Heroicons: document-text --}}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                            </svg>
                            View Resume
                        </button>
                    </div>
                    {{-- Social links --}}
                    <div class="flex items-center gap-4 pt-2">
                        <span class="section-kicker text-xs text-zinc-400 uppercase">Find me on</span>
                        <div class="flex gap-3">
                            <button onclick="openGithubNotice()"
                               aria-label="GitHub" class="w-10 h-10 rounded-lg border border-zinc-900/10 dark:border-white/10 bg-white/60 dark:bg-white/5 flex items-center justify-center hover:border-[#B91C1C] hover:text-[#B91C1C] transition text-zinc-500">
                                {{-- GitHub brand SVG --}}
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                                </svg>
                            </button>
                            <a href="https://www.linkedin.com/in/exequiel-lustan-19b610281/" target="_blank" rel="noopener noreferrer"
                               aria-label="LinkedIn" class="w-10 h-10 rounded-lg border border-zinc-900/10 dark:border-white/10 bg-white/60 dark:bg-white/5 flex items-center justify-center hover:border-[#B91C1C] hover:text-[#B91C1C] transition text-zinc-500">
                                {{-- LinkedIn brand SVG --}}
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Photo --}}
                <div class="flex justify-center lg:justify-end section-fade">
                    <div class="relative">
                        <div class="relative">
                            <img src="{{ asset('assets/illustrations/portfolio.jpg') }}"
                                 alt="Exequiel Lustan — Full-Stack Developer"
                                 class="photo-lift w-80 h-80 lg:w-96 lg:h-96 object-cover rounded-lg border border-white/80 dark:border-white/10"/>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Scroll indicator --}}
            <div class="flex justify-center mt-10 lg:mt-16">
                <a href="#about" class="flex flex-col items-center gap-1 text-zinc-400 hover:text-[#B91C1C] transition">
                    <span class="section-kicker text-xs uppercase">Scroll</span>
                    {{-- Heroicons: chevron-down --}}
                    <svg class="w-4 h-4 animate-bounce" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ── About ────────────────────────────────────────────────────────────── --}}
    <section id="about" class="py-28 lg:py-36 bg-white dark:bg-[#101111]">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
            <div class="grid lg:grid-cols-[.95fr_1.05fr] gap-16 lg:gap-24 items-center">
                <div class="section-fade space-y-8">
                    <div>
                        <p class="section-kicker text-sm font-semibold text-[#B91C1C] uppercase mb-3">About Me</p>
                        <h2 class="text-4xl md:text-5xl font-bold leading-tight">Turning ideas into<br><span class="gradient-text">digital reality</span></h2>
                    </div>
                    <blockquote class="border-l-2 border-[#B91C1C] pl-6 text-zinc-600 dark:text-zinc-300 leading-8 italic">
                        "I believe great software is the intersection of clean engineering and thoughtful design. I don't just write code — I architect solutions that scale."
                    </blockquote>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-8">
                        I'm a passionate full-stack developer based in Legazpi City, Philippines. A graduate of <strong class="text-[#1b1b18] dark:text-white">BS Computer Science</strong> and currently pursuing a <strong class="text-[#1b1b18] dark:text-white">Master in Information System</strong>. I specialize in <strong class="text-[#1b1b18] dark:text-white">Laravel, Filament, Livewire & Blade Templates</strong> applications and have a growing edge in AI-assisted development workflows.
                    </p>
                    <div class="flex flex-wrap gap-2.5 pt-2">
                        @foreach($tags as $tag)
                            <span class="text-xs font-semibold bg-[#B91C1C]/10 text-[#B91C1C] border border-[#B91C1C]/10 px-3 py-1.5 rounded-full">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>
                <div class="section-fade grid grid-cols-2 gap-4 md:gap-5">
                    @foreach([
                        ['label' => 'Projects Delivered', 'value' => '6'],
                        ['label' => 'Production Systems', 'value' => '4'],
                        ['label' => 'Technologies',       'value' => '15+'],
                        ['label' => 'Happy Clients',      'value' => '10+'],
                    ] as $stat)
                        <div class="card-hover bg-[#f6f7f2] dark:bg-white/5 border border-zinc-900/5 dark:border-white/10 rounded-lg p-7 md:p-8 text-center">
                            <div class="text-3xl md:text-4xl font-bold text-[#B91C1C]">{{ $stat['value'] }}</div>
                            <div class="text-sm text-zinc-500 dark:text-zinc-400 mt-2">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ── Laravel Live Japan ──────────────────────────────────────────────── --}}
    <section id="conference" class="py-28 lg:py-36 bg-[#f6f7f2] dark:bg-[#0b0c0c]">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
            <div class="grid lg:grid-cols-[.72fr_1.28fr] gap-14 lg:gap-20 items-start">
                <div class="section-fade lg:sticky lg:top-28 space-y-7">
                    <div>
                        <p class="section-kicker text-sm font-semibold text-[#B91C1C] uppercase mb-3">Laravel Live Japan</p>
                        <h2 class="text-4xl md:text-5xl font-bold leading-tight">
                            My first Laravel Live conference in Japan.
                        </h2>
                    </div>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-8">
                        This was more than a trip photo album. It was my first time attending Laravel Live, surrounded by the community and craft behind the framework I use every day.
                    </p>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div class="rounded-lg border border-zinc-900/10 dark:border-white/10 bg-white/70 dark:bg-white/5 p-4">
                            <p class="section-kicker text-[11px] uppercase text-zinc-400">Milestone</p>
                            <p class="mt-1 font-semibold">First Laravel Live</p>
                        </div>
                        <div class="rounded-lg border border-zinc-900/10 dark:border-white/10 bg-white/70 dark:bg-white/5 p-4">
                            <p class="section-kicker text-[11px] uppercase text-zinc-400">Location</p>
                            <p class="mt-1 font-semibold">Japan</p>
                        </div>
                    </div>
                </div>

                <div class="section-fade grid md:grid-cols-4 auto-rows-[220px] sm:auto-rows-[260px] lg:auto-rows-[230px] gap-4">
                    @foreach($conferencePhotos as $photo)
                        <figure class="{{ $photo['class'] }} overflow-hidden rounded-lg border border-white/80 dark:border-white/10 bg-white dark:bg-white/5 photo-lift">
                            <img
                                src="{{ asset($photo['src']) }}"
                                alt="{{ $photo['alt'] }}"
                                class="h-full w-full object-cover transition duration-500 hover:scale-[1.03]"
                                loading="lazy"
                            >
                        </figure>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ── AI Skills ────────────────────────────────────────────────────────── --}}
    <section id="ai" class="py-28 lg:py-36 bg-white dark:bg-[#101111]">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
            <div class="text-center max-w-2xl mx-auto mb-16 section-fade">
                <p class="section-kicker text-sm font-semibold text-[#B91C1C] uppercase mb-3">Workflow</p>
                <h2 class="text-4xl md:text-5xl font-bold mb-5">Thoughtful <span class="gradient-text">Development</span></h2>
                <p class="text-zinc-600 dark:text-zinc-300 leading-8">
                    I use modern tooling with discipline: clear requirements, careful review, readable code, and tests that keep the work grounded.
                </p>
            </div>

            {{-- Featured AI banner --}}
            <div class="section-fade mb-10">
                <div class="relative overflow-hidden rounded-lg bg-[#18181b] border border-zinc-900/10 dark:border-white/10 p-8 md:p-12 text-white">
                    <div class="relative grid md:grid-cols-2 gap-8 items-center">
                        <div class="space-y-4">
                            <div class="inline-flex items-center gap-2 bg-white/10 text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                                {{-- Heroicons: sparkles --}}
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/>
                                </svg>
                                Workflow Detail
                            </div>
                            <h3 class="text-3xl font-bold">Practical AI-Assisted Programming</h3>
                            <p class="text-white/75 leading-8">
                                I use Claude, ChatGPT, and GitHub Copilot as supporting tools for exploration, review, and implementation details while keeping architecture, judgment, and accountability in my own hands.
                            </p>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach(['Claude AI', 'ChatGPT', 'GitHub Copilot', 'OpenAI API', 'Anthropic API', 'Cursor IDE'] as $tool)
                                <div class="bg-white/10 backdrop-blur-sm border border-white/15 rounded-lg px-4 py-2.5 text-sm font-semibold text-center">
                                    {{ $tool }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-fade grid md:grid-cols-2 gap-6">
                @foreach($aiSkills as $skill)
                    <div class="card-hover bg-[#f6f7f2] dark:bg-white/5 border border-zinc-900/5 dark:border-white/10 rounded-lg p-7">
                        <div class="w-10 h-10 bg-[#B91C1C]/10 rounded-lg flex items-center justify-center text-[#B91C1C] mb-5">
                            {{-- Heroicons: cpu-chip --}}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-bold mb-2 text-[#1b1b18] dark:text-white">{{ $skill['title'] }}</h3>
                        <p class="text-sm text-zinc-600 dark:text-zinc-300 leading-7">{{ $skill['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Technical Skills ─────────────────────────────────────────────────── --}}
    <section id="skills" class="py-28 lg:py-36 bg-[#f6f7f2] dark:bg-[#0b0c0c]">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
            <div class="text-center max-w-2xl mx-auto mb-16 section-fade">
                <p class="section-kicker text-sm font-semibold text-[#B91C1C] uppercase mb-3">Technical Arsenal</p>
                <h2 class="text-4xl md:text-5xl font-bold">Skills & <span class="gradient-text">Technologies</span></h2>
            </div>

            <div class="section-fade grid md:grid-cols-2 gap-10 lg:gap-16">
                {{-- Backend --}}
                <div class="space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-[#B91C1C]/10 rounded-lg flex items-center justify-center text-[#B91C1C]">
                            {{-- Heroicons: wrench-screwdriver --}}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold uppercase section-kicker text-sm">Backend Development</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($backendSkills as $skill)
                            <span class="skill-tag border border-dashed border-[#B91C1C]/40 bg-white/60 dark:bg-white/5 text-sm px-3.5 py-2 rounded-lg hover:bg-[#B91C1C]/5 dark:hover:bg-[#B91C1C]/10 cursor-default">
                                {{ $skill }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- Frontend --}}
                <div class="space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-[#B91C1C]/10 rounded-lg flex items-center justify-center text-[#B91C1C]">
                            {{-- Heroicons: paint-brush --}}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42"/>
                            </svg>
                        </div>
                        <h3 class="font-bold uppercase section-kicker text-sm">Frontend Development</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($frontendSkills as $skill)
                            <span class="skill-tag border border-dashed border-[#B91C1C]/40 bg-white/60 dark:bg-white/5 text-sm px-3.5 py-2 rounded-lg hover:bg-[#B91C1C]/5 dark:hover:bg-[#B91C1C]/10 cursor-default">
                                {{ $skill }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Cloud & Deployment ───────────────────────────────────────────────── --}}
    <section id="deployment" class="py-28 lg:py-36 bg-white dark:bg-[#101111]">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
            <div class="text-center max-w-2xl mx-auto mb-16 section-fade">
                <p class="section-kicker text-sm font-semibold text-[#B91C1C] uppercase mb-3">Infrastructure</p>
                <h2 class="text-4xl md:text-5xl font-bold">Cloud & <span class="gradient-text">Deployment</span></h2>
                <p class="text-zinc-600 dark:text-zinc-300 mt-5 leading-8">
                    From server provisioning to managed platforms — I deploy Laravel applications to production with confidence across multiple cloud environments.
                </p>
            </div>

            <div class="section-fade grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($deploymentPlatforms as $platform)
                    <div class="card-hover relative bg-[#f6f7f2] dark:bg-white/5 border {{ $platform['current'] ? 'border-[#673DE6]/40' : 'border-zinc-900/5 dark:border-white/10' }} rounded-lg p-7 flex flex-col gap-5">
                        @if($platform['current'])
                            <div class="absolute top-4 right-4 flex items-center gap-1.5 text-xs font-semibold text-[#673DE6]">
                                <span class="w-2 h-2 bg-[#673DE6] rounded-full animate-pulse"></span>
                                Hosting this site
                            </div>
                        @endif
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 {{ $platform['bg'] }} {{ $platform['color'] }} rounded-lg flex items-center justify-center shrink-0">
                                {!! $platform['icon'] !!}
                            </div>
                            <div>
                                <h3 class="font-bold text-lg leading-tight">{{ $platform['name'] }}</h3>
                                <p class="text-xs text-gray-400">{{ $platform['label'] }}</p>
                            </div>
                        </div>
                        <p class="text-sm text-zinc-600 dark:text-zinc-300 leading-7 flex-1">
                            {{ $platform['desc'] }}
                        </p>
                        <div class="flex flex-wrap gap-2 pt-3 border-t border-zinc-900/5 dark:border-white/10">
                            @foreach($platform['badges'] as $badge)
                                <span class="text-xs font-medium border border-dashed border-[#B91C1C]/40 text-[#B91C1C] px-2.5 py-1 rounded-md">
                                    {{ $badge }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Projects ─────────────────────────────────────────────────────────── --}}
    <section id="projects" class="py-28 lg:py-36 bg-[#f6f7f2] dark:bg-[#0b0c0c]">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
            <div class="flex items-end justify-between mb-16 section-fade flex-wrap gap-4">
                <div>
                    <p class="section-kicker text-sm font-semibold text-[#B91C1C] uppercase mb-3">Portfolio</p>
                    <h2 class="text-4xl md:text-5xl font-bold">Featured <span class="gradient-text">Projects</span></h2>
                </div>
                <p class="text-zinc-500 dark:text-zinc-400 text-sm max-w-xs lg:text-right leading-7">
                    Real-world solutions built with modern Laravel, Livewire, and maintainable delivery workflows.
                </p>
            </div>

            <div class="section-fade grid md:grid-cols-2 gap-6">
                @foreach($projects as $project)
                    <article class="card-hover group bg-white dark:bg-white/5 border border-zinc-900/5 dark:border-white/10 rounded-lg p-7 md:p-8 flex flex-col gap-5">
                        <div class="flex items-center gap-2 justify-end">
                            <span class="text-xs text-gray-400">{{ $project['year'] }}</span>
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full
                                {{ $project['status'] === 'Live'
                                    ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400'
                                    : 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400' }}">
                                {{ $project['status'] }}
                            </span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold mb-2 group-hover:text-[#B91C1C] transition leading-snug">{{ $project['title'] }}</h3>
                            <a href="{{ $project['url'] }}" target="_blank" rel="noopener noreferrer"
                               class="text-xs text-gray-400 hover:text-[#B91C1C] transition mb-2 inline-flex items-center gap-1">
                                {{-- Heroicons: arrow-top-right-on-square --}}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                                </svg>
                                {{ parse_url($project['url'], PHP_URL_HOST) }}
                            </a>
                            <p class="text-sm text-zinc-600 dark:text-zinc-300 leading-7 mt-3">{{ $project['desc'] }}</p>
                        </div>
                        <div class="flex flex-wrap gap-2 pt-3 border-t border-zinc-900/5 dark:border-white/10">
                            @foreach($project['tags'] as $tag)
                                <span class="text-xs font-medium bg-[#B91C1C]/10 text-[#B91C1C] px-2.5 py-1 rounded-md">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Open Source ─────────────────────────────────────────────────────── --}}
    <section id="opensource" class="py-28 lg:py-36 bg-white dark:bg-[#101111]">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
            <div class="grid lg:grid-cols-[.85fr_1.15fr] gap-12 lg:gap-20 items-start">
                <div class="section-fade space-y-7">
                    <div>
                        <p class="section-kicker text-sm font-semibold text-[#B91C1C] uppercase mb-3">Open Source</p>
                        <h2 class="text-4xl md:text-5xl font-bold leading-tight">
                            GitHub work shaped around Laravel, automation, and useful tools.
                        </h2>
                    </div>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-8">
                        My GitHub profile reflects the work I enjoy most: building web applications, automating business processes, exploring practical AI tooling, and turning side-project ideas into reusable code.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="https://github.com/neon2027" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 bg-[#18181b] text-white font-semibold px-5 py-3 rounded-lg hover:bg-[#B91C1C] transition-all duration-200 shadow-lg shadow-zinc-900/15">
                            View GitHub
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                            </svg>
                        </a>
                        <a href="https://github.com/neon2027/neon2027/blob/main/README.md" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 border border-zinc-900/10 dark:border-white/10 bg-white/50 dark:bg-white/5 text-[#1b1b18] dark:text-white font-semibold px-5 py-3 rounded-lg hover:border-[#B91C1C] hover:text-[#B91C1C] transition-all duration-200">
                            Profile README
                        </a>
                    </div>
                </div>

                <div class="section-fade space-y-6">
                    <article class="card-hover bg-[#f6f7f2] dark:bg-white/5 border border-zinc-900/5 dark:border-white/10 rounded-lg p-7 md:p-8">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
                            <div class="space-y-4">
                                <div>
                                    <p class="section-kicker text-xs font-semibold uppercase text-zinc-400 mb-2">Latest Package</p>
                                    <h3 class="text-2xl font-bold leading-tight">sql-to-signal</h3>
                                </div>
                                <p class="text-zinc-600 dark:text-zinc-300 leading-7">
                                    Call <code class="rounded bg-white/80 dark:bg-black/30 px-1.5 py-0.5 text-sm">-&gt;toSignal()</code> on an Eloquent or Query Builder chain and get a reactive Signal object ready for Livewire and Alpine.js.
                                </p>
                            </div>
                            <div class="flex md:flex-col gap-2 shrink-0">
                                <a href="https://github.com/neon2027/sql-to-signal" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center justify-center gap-2 rounded-lg border border-zinc-900/10 dark:border-white/10 bg-white/70 dark:bg-white/5 px-4 py-2 text-sm font-semibold hover:border-[#B91C1C] hover:text-[#B91C1C] transition">
                                    Repository
                                </a>
                                <span class="inline-flex items-center justify-center rounded-lg border border-[#B91C1C]/20 bg-[#B91C1C]/10 px-4 py-2 text-sm font-semibold text-[#B91C1C]">
                                    MIT
                                </span>
                            </div>
                        </div>

                        <div class="mt-7 grid sm:grid-cols-2 gap-3">
                            @foreach($packageFeatures as $feature)
                                <div class="rounded-lg border border-zinc-900/5 dark:border-white/10 bg-white/70 dark:bg-black/10 p-4 text-sm text-zinc-600 dark:text-zinc-300 leading-6">
                                    {{ $feature }}
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-7 rounded-lg border border-zinc-900/10 dark:border-white/10 bg-[#18181b] p-4 text-sm text-white">
                            <p class="section-kicker text-[11px] uppercase text-white/50 mb-2">Install</p>
                            <code>composer require laravelldone/sql-to-signal</code>
                        </div>
                    </article>

                    <article class="card-hover bg-[#f6f7f2] dark:bg-white/5 border border-zinc-900/5 dark:border-white/10 rounded-lg p-7 md:p-8">
                        <p class="section-kicker text-xs font-semibold uppercase text-zinc-400 mb-4">Profile README Highlights</p>
                        <div class="grid sm:grid-cols-2 gap-3">
                            @foreach($githubHighlights as $highlight)
                                <div class="rounded-lg border border-zinc-900/5 dark:border-white/10 bg-white/70 dark:bg-black/10 p-4 text-sm font-semibold">
                                    {{ $highlight }}
                                </div>
                            @endforeach
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Education ────────────────────────────────────────────────────────── --}}
    <section id="education" class="py-28 lg:py-36 bg-white dark:bg-[#101111]">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
            <div class="text-center max-w-2xl mx-auto mb-16 section-fade">
                <p class="section-kicker text-sm font-semibold text-[#B91C1C] uppercase mb-3">Background</p>
                <h2 class="text-4xl md:text-5xl font-bold">Education & <span class="gradient-text">Formation</span></h2>
            </div>
            <div class="section-fade max-w-2xl mx-auto space-y-6">
                @foreach([
                    ['degree' => 'Master in Information System', 'school' => 'Bicol University', 'place' => 'Legazpi City, Philippines', 'period' => '2025 — Present', 'current' => true],
                    ['degree' => 'B.S. Computer Science',        'school' => 'Bicol University', 'place' => 'Legazpi City, Philippines', 'period' => '2018 — 2022',    'current' => false],
                ] as $edu)
                    <div class="card-hover relative bg-[#f6f7f2] dark:bg-white/5 border {{ $edu['current'] ? 'border-[#B91C1C]/40' : 'border-zinc-900/5 dark:border-white/10' }} rounded-lg p-6 flex gap-5 items-start">
                        @if($edu['current'])
                            <div class="absolute top-4 right-4 flex items-center gap-1.5 text-xs font-semibold text-[#B91C1C]">
                                <span class="w-2 h-2 bg-[#B91C1C] rounded-full animate-pulse"></span>
                                Current
                            </div>
                        @endif
                        <div class="w-12 h-12 rounded-lg {{ $edu['current'] ? 'bg-[#B91C1C] text-white' : 'bg-white dark:bg-white/5 text-gray-500 dark:text-gray-400' }} flex items-center justify-center shrink-0">
                            {{-- Heroicons: academic-cap --}}
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">{{ $edu['degree'] }}</h3>
                            <p class="font-semibold text-[#B91C1C] text-sm">{{ $edu['school'] }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $edu['place'] }}</p>
                            <p class="text-xs text-gray-400 mt-1 italic">{{ $edu['period'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Contact ───────────────────────────────────────────────────────────── --}}
    <section id="contact" class="py-28 lg:py-36 bg-[#f6f7f2] dark:bg-[#0b0c0c]">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
            <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-start">
                {{-- Left info --}}
                <div class="section-fade space-y-8">
                    <div>
                        <p class="section-kicker text-sm font-semibold text-[#B91C1C] uppercase mb-3">Get In Touch</p>
                        <h2 class="text-4xl md:text-5xl font-bold mb-5 leading-tight">Let's build something <span class="gradient-text">great together</span></h2>
                        <p class="text-zinc-600 dark:text-zinc-300 leading-8">
                            Whether you have a project in mind, a job opportunity, or just want to say hello — my inbox is always open. I'll get back to you within 24 hours.
                        </p>
                    </div>
                    <div class="space-y-4">
                        @foreach([
                            ['label' => 'Email',    'value' => 'lustanexequiel@gmail.com', 'href' => 'mailto:lustanexequiel@gmail.com', 'icon' => 'envelope'],
                            ['label' => 'Location', 'value' => 'Legazpi City, Philippines',  'href' => null, 'icon' => 'map-pin'],
                            ['label' => 'Work',     'value' => 'Laravel applications, systems, and consulting', 'href' => null, 'icon' => 'briefcase'],
                        ] as $info)
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-[#B91C1C]/10 rounded-lg flex items-center justify-center text-[#B91C1C] shrink-0">
                                    @if($info['icon'] === 'envelope')
                                        {{-- Heroicons: envelope --}}
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                                        </svg>
                                    @elseif($info['icon'] === 'map-pin')
                                        {{-- Heroicons: map-pin --}}
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                                        </svg>
                                    @else
                                        {{-- Heroicons: briefcase --}}
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z"/>
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">{{ $info['label'] }}</p>
                                    @if($info['href'])
                                        <a href="{{ $info['href'] }}" class="font-semibold text-[#1b1b18] dark:text-white hover:text-[#B91C1C] transition text-sm">
                                            {{ $info['value'] }}
                                        </a>
                                    @else
                                        <p class="font-semibold text-sm">{{ $info['value'] }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Contact form --}}
                <div class="section-fade">
                    <div class="bg-white dark:bg-white/5 border border-zinc-900/5 dark:border-white/10 rounded-lg p-8 shadow-sm">
                        <h3 class="font-bold text-lg mb-6 text-[#1b1b18] dark:text-white">Send a Message</h3>
                        <livewire:contact-form/>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Footer ───────────────────────────────────────────────────────────── --}}
    <footer class="bg-white dark:bg-[#101111] border-t border-zinc-900/5 dark:border-white/10 py-8">
        <div class="max-w-7xl mx-auto px-6 md:px-10 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-gray-500 dark:text-gray-400">
            <p>
                &copy; {{ date('Y') }}
                <span class="font-semibold text-[#B91C1C]">Exequiel Lustan</span>
                — Built with Laravel & Livewire
            </p>
            <p>Designed and developed in the Philippines.</p>
        </div>
    </footer>

    {{-- ── GitHub Notice Modal ─────────────────────────────────────────────── --}}
    <div id="github-notice-modal"
         class="fixed inset-0 z-[100] hidden items-center justify-center p-4"
         aria-modal="true" role="dialog" aria-labelledby="github-notice-title">

        {{-- Backdrop --}}
        <div id="github-backdrop" class="absolute inset-0 bg-black/70 backdrop-blur-sm"
             onclick="closeGithubNotice()"></div>

        {{-- Panel --}}
        <div id="github-panel" class="relative z-10 w-full max-w-md bg-white dark:bg-[#111] rounded-lg shadow-2xl overflow-hidden">

            {{-- Top accent bar --}}
            <div class="h-1 w-full bg-gradient-to-r from-[#B91C1C] to-[#FF9900]"></div>

            <div class="p-7 flex flex-col gap-5">

                {{-- Header --}}
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 bg-gray-100 dark:bg-gray-800 rounded-xl flex items-center justify-center shrink-0">
                            {{-- GitHub icon --}}
                            <svg class="w-5 h-5 text-[#1b1b18] dark:text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 id="github-notice-title" class="font-bold text-base">github.com/neon2027</h2>
                            <p class="text-xs text-gray-400">Exequiel Lustan</p>
                        </div>
                    </div>
                    <button onclick="closeGithubNotice()"
                            class="w-7 h-7 rounded-lg flex items-center justify-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition shrink-0"
                            aria-label="Close">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Lock notice --}}
                <div class="bg-amber-50 dark:bg-amber-400/10 border border-amber-200 dark:border-amber-400/20 rounded-xl p-4 flex gap-3">
                    <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-amber-700 dark:text-amber-400 mb-1">Repositories are Private</p>
                        <p class="text-xs text-amber-600 dark:text-amber-300/80 leading-relaxed">
                            My repositories are kept private to protect client work and proprietary code. They are not publicly viewable on GitHub.
                        </p>
                    </div>
                </div>

                {{-- Body --}}
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                    I'm happy to walk you through any project, codebase, or implementation in a <strong class="text-[#1b1b18] dark:text-white">one-on-one meeting</strong>. We can do a live code walkthrough, architecture discussion, or Q&A — whatever works best for you.
                </p>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-1">
                    <a href="#contact"
                       onclick="closeGithubNotice()"
                       class="flex-1 inline-flex items-center justify-center gap-2 bg-[#B91C1C] text-white text-sm font-semibold px-4 py-2.5 rounded-lg hover:bg-[#B91C1C] transition">
                        {{-- Heroicons: calendar-days --}}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z"/>
                        </svg>
                        Schedule a Meeting
                    </a>
                    <button onclick="closeGithubNotice()"
                            class="flex-1 inline-flex items-center justify-center gap-2 border border-gray-200 dark:border-gray-700 text-sm font-semibold px-4 py-2.5 rounded-lg hover:border-[#B91C1C] hover:text-[#B91C1C] transition">
                        Maybe Later
                    </button>
                </div>

                {{-- Continue to GitHub --}}
                <a href="https://github.com/neon2027" target="_blank" rel="noopener noreferrer"
                   onclick="closeGithubNotice()"
                   class="inline-flex items-center justify-center gap-1.5 text-xs text-gray-400 hover:text-[#B91C1C] transition py-1">
                    {{-- Heroicons: arrow-top-right-on-square --}}
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                    </svg>
                    Continue to GitHub anyway
                </a>
            </div>
        </div>
    </div>

    {{-- ── Resume Viewer Modal ─────────────────────────────────────────────── --}}
    <div id="resume-modal"
         class="fixed inset-0 z-[100] hidden items-center justify-center p-4"
         aria-modal="true" role="dialog" aria-labelledby="resume-modal-title">

        {{-- Backdrop --}}
        <div id="resume-backdrop"
             class="absolute inset-0 bg-black/70 backdrop-blur-sm"
             onclick="closeResume()"></div>

        {{-- Panel --}}
        <div class="relative z-10 w-full max-w-4xl max-h-[90vh] bg-white dark:bg-[#111] rounded-lg shadow-2xl flex flex-col overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-100 dark:border-gray-800 shrink-0">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 bg-[#B91C1C]/10 rounded-lg flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-[#B91C1C]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                        </svg>
                    </div>
                    <span id="resume-modal-title" class="text-sm font-semibold text-[#1b1b18] dark:text-white">Exequiel Lustan — Resume</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="hidden sm:inline-flex items-center gap-1.5 text-xs text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-400/10 border border-amber-200 dark:border-amber-400/20 px-2.5 py-1 rounded-full font-medium">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                        </svg>
                        View only
                    </span>
                    {{-- Zoom controls --}}
                    <div class="flex items-center gap-1 border border-gray-200 dark:border-gray-700 rounded-lg px-1 py-0.5">
                        <button onclick="zoomResume(-1)" aria-label="Zoom out"
                                class="w-6 h-6 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:text-[#B91C1C] transition rounded">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
                            </svg>
                        </button>
                        <span id="resume-zoom-label" class="text-xs font-medium text-gray-500 dark:text-gray-400 w-10 text-center">100%</span>
                        <button onclick="zoomResume(1)" aria-label="Zoom in"
                                class="w-6 h-6 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:text-[#B91C1C] transition rounded">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
                            </svg>
                        </button>
                    </div>
                    <button onclick="closeResume()"
                            class="w-7 h-7 rounded-lg flex items-center justify-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                            aria-label="Close">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- PDF canvas area --}}
            <div id="resume-container"
                 class="flex-1 overflow-y-auto bg-gray-100 dark:bg-[#0a0a0a] p-4 select-none"
                 oncontextmenu="return false">

                {{-- Loading state --}}
                <div id="resume-loading" class="flex flex-col items-center justify-center py-20 gap-3">
                    <div class="w-8 h-8 border-2 border-[#B91C1C] border-t-transparent rounded-full animate-spin"></div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Loading resume…</p>
                </div>

                {{-- Error state --}}
                <div id="resume-error" class="hidden flex-col items-center justify-center py-20 gap-3 text-center">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                    </svg>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Resume not available at the moment.</p>
                </div>

                {{-- Pages will be appended here as <canvas> --}}
                <div id="resume-pages" class="hidden flex flex-col items-center gap-4"></div>
            </div>

            {{-- Footer --}}
            <div class="shrink-0 px-5 py-3 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between text-xs text-gray-400">
                <span id="resume-page-info"></span>
                <span>Contact me to request a copy</span>
            </div>
        </div>
    </div>

    {{-- PDF.js (Mozilla) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

    @livewireScripts

    <script>
        // ── Resume viewer ─────────────────────────────────────────────────────
        const resumeModal     = document.getElementById('resume-modal');
        const resumePages     = document.getElementById('resume-pages');
        const resumeLoading   = document.getElementById('resume-loading');
        const resumeError     = document.getElementById('resume-error');
        const resumePageInfo  = document.getElementById('resume-page-info');
        const resumeZoomLabel = document.getElementById('resume-zoom-label');

        let resumePdf        = null;
        let resumeBaseScale  = 1.5;   // initial fit scale (set after first load)
        let resumeZoomStep   = 0;     // steps from base: -3 … +5
        const ZOOM_STEPS     = [0.5, 0.67, 0.75, 1, 1.25, 1.5, 1.75, 2, 2.5, 3];
        let resumeZoomIndex  = 5;     // default index → 1.5×

        function currentScale() { return ZOOM_STEPS[resumeZoomIndex]; }

        function openResume() {
            resumeModal.classList.remove('hidden');
            resumeModal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            if (!resumePdf) loadResumePdf();
        }

        function closeResume() {
            resumeModal.classList.add('hidden');
            resumeModal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        async function zoomResume(dir) {
            const next = resumeZoomIndex + dir;
            if (next < 0 || next >= ZOOM_STEPS.length) return;
            resumeZoomIndex = next;
            resumeZoomLabel.textContent = Math.round(ZOOM_STEPS[resumeZoomIndex] * 100) + '%';
            if (resumePdf) await drawPages();
        }

        // Close on Escape; block save/print shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') { closeResume(); return; }
            if (!resumeModal.classList.contains('hidden')) {
                if ((e.ctrlKey || e.metaKey) && ['s','p','S','P'].includes(e.key)) {
                    e.preventDefault(); e.stopPropagation();
                }
                // Ctrl +/- zoom
                if ((e.ctrlKey || e.metaKey) && (e.key === '+' || e.key === '=')) {
                    e.preventDefault(); zoomResume(1);
                }
                if ((e.ctrlKey || e.metaKey) && e.key === '-') {
                    e.preventDefault(); zoomResume(-1);
                }
            }
        });

        // Mouse-wheel zoom (Ctrl + scroll)
        document.getElementById('resume-container').addEventListener('wheel', (e) => {
            if (e.ctrlKey || e.metaKey) {
                e.preventDefault();
                zoomResume(e.deltaY < 0 ? 1 : -1);
            }
        }, { passive: false });

        window.addEventListener('beforeprint', (e) => {
            if (!resumeModal.classList.contains('hidden')) e.preventDefault();
        });

        async function loadResumePdf() {
            if (typeof pdfjsLib === 'undefined') { showResumeError(); return; }

            pdfjsLib.GlobalWorkerOptions.workerSrc =
                'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

            try {
                resumePdf = await pdfjsLib.getDocument({
                    url: '{{ route("resume.view") }}',
                    withCredentials: false,
                }).promise;

                resumePageInfo.textContent =
                    `${resumePdf.numPages} page${resumePdf.numPages > 1 ? 's' : ''}`;

                // Pick a fit-to-width base scale from the first page
                const firstPage     = await resumePdf.getPage(1);
                const naturalWidth  = firstPage.getViewport({ scale: 1 }).width;
                const containerW    = resumePages.clientWidth - 32;
                const fitScale      = Math.min(1.5, containerW / naturalWidth);
                // Find the closest zoom step to fitScale
                resumeZoomIndex = ZOOM_STEPS.reduce((best, s, i) =>
                    Math.abs(s - fitScale) < Math.abs(ZOOM_STEPS[best] - fitScale) ? i : best, resumeZoomIndex);
                resumeZoomLabel.textContent = Math.round(ZOOM_STEPS[resumeZoomIndex] * 100) + '%';

                await drawPages();

                resumeLoading.classList.add('hidden');
                resumePages.classList.remove('hidden');
                resumePages.classList.add('flex');
            } catch {
                showResumeError();
            }
        }

        async function drawPages() {
            resumePages.innerHTML = '';
            const scale = currentScale();

            for (let i = 1; i <= resumePdf.numPages; i++) {
                const page     = await resumePdf.getPage(i);
                const viewport = page.getViewport({ scale });

                const canvas         = document.createElement('canvas');
                canvas.width         = viewport.width;
                canvas.height        = viewport.height;
                canvas.className     = 'rounded-lg shadow-md';
                canvas.style.cssText = 'user-select:none;-webkit-user-select:none;pointer-events:none;max-width:100%;';

                await page.render({ canvasContext: canvas.getContext('2d'), viewport }).promise;
                resumePages.appendChild(canvas);
            }
        }

        function showResumeError() {
            resumeLoading.classList.add('hidden');
            resumeError.classList.remove('hidden');
            resumeError.classList.add('flex');
        }
        // ─────────────────────────────────────────────────────────────────────

        // ── GitHub Notice Modal ───────────────────────────────────────────────
        const githubModal    = document.getElementById('github-notice-modal');
        const githubBackdrop = document.getElementById('github-backdrop');
        const githubPanel    = document.getElementById('github-panel');

        function openGithubNotice() {
            githubModal.classList.remove('hidden');
            githubModal.classList.add('flex');
            document.body.style.overflow = 'hidden';

            githubBackdrop.classList.remove('modal-backdrop-leave');
            githubPanel.classList.remove('modal-panel-leave');
            githubBackdrop.classList.add('modal-backdrop-enter');
            githubPanel.classList.add('modal-panel-enter');
        }

        function closeGithubNotice() {
            githubBackdrop.classList.remove('modal-backdrop-enter');
            githubPanel.classList.remove('modal-panel-enter');
            githubBackdrop.classList.add('modal-backdrop-leave');
            githubPanel.classList.add('modal-panel-leave');

            githubPanel.addEventListener('animationend', () => {
                githubModal.classList.add('hidden');
                githubModal.classList.remove('flex');
                document.body.style.overflow = '';
                githubBackdrop.classList.remove('modal-backdrop-leave');
                githubPanel.classList.remove('modal-panel-leave');
            }, { once: true });
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !githubModal.classList.contains('hidden')) {
                closeGithubNotice();
            }
        });
        // ─────────────────────────────────────────────────────────────────────

        document.getElementById('menu-toggle')?.addEventListener('click', () => {
            document.getElementById('mobile-menu')?.classList.toggle('hidden');
        });

        const observer = new IntersectionObserver(
            (entries) => entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); }),
            { threshold: 0.12 }
        );
        document.querySelectorAll('.section-fade').forEach(el => observer.observe(el));

        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('header a[href^="#"]');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(s => { if (window.scrollY >= s.offsetTop - 100) current = s.id; });
            navLinks.forEach(a => {
                a.classList.toggle('text-[#B91C1C]', a.getAttribute('href') === '#' + current);
            });
        }, { passive: true });
    </script>
</body>
</html>
