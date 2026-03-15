<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SEO --}}
    <title>Exequiel Lustan — Full-Stack Developer & AI-Assisted Programmer</title>
    <meta name="description" content="Exequiel Lustan is a full-stack developer specializing in Laravel, Vue.js, and AI-assisted programming. Available for hire — let's build something great together.">
    <meta name="keywords" content="full-stack developer, Laravel developer, Vue.js, PHP, AI-assisted programming, portfolio, hire developer, Philippines">
    <meta name="author" content="Exequiel Lustan">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/') }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Exequiel Lustan — Full-Stack Developer & AI-Assisted Programmer">
    <meta property="og:description" content="Full-stack developer specializing in Laravel, Vue.js, and AI-assisted programming. Let's build something great.">
    <meta property="og:image" content="{{ asset('assets/illustrations/portfolio.jpg') }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Exequiel Lustan — Full-Stack Developer">
    <meta name="twitter:description" content="Full-stack developer specializing in Laravel, Vue.js, and AI-assisted programming.">
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
        .section-fade { opacity: 0; transform: translateY(24px); transition: opacity .6s ease, transform .6s ease; }
        .section-fade.visible { opacity: 1; transform: none; }
        .gradient-text {
            background: linear-gradient(135deg, #DC2626 0%, #F87171 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .ai-badge {
            background: linear-gradient(135deg, #DC2626 0%, #7C3AED 100%);
        }
        .card-hover { transition: transform .25s ease, box-shadow .25s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(220,38,38,.12); }
        .skill-tag { transition: all .2s ease; }
        .skill-tag:hover { border-style: solid; transform: translateY(-2px); }
        .nav-link { position: relative; }
        .nav-link::after { content:''; position:absolute; bottom:-2px; left:0; width:0; height:2px; background:#DC2626; transition: width .3s ease; }
        .nav-link:hover::after { width:100%; }
    </style>
</head>

@php
    $backendSkills = [
        ['name' => 'PHP', 'icon' => '🐘'],
        ['name' => 'Laravel', 'icon' => '🔴'],
        ['name' => 'Node.js', 'icon' => '🟢'],
        ['name' => 'MySQL', 'icon' => '🗄️'],
        ['name' => 'PostgreSQL', 'icon' => '🐘'],
        ['name' => 'Redis', 'icon' => '⚡'],
        ['name' => 'REST APIs', 'icon' => '🔌'],
        ['name' => 'Authentication', 'icon' => '🔐'],
        ['name' => 'Testing (Pest)', 'icon' => '🧪'],
        ['name' => 'Git & DevOps', 'icon' => '🚀'],
    ];

    $frontendSkills = [
        ['name' => 'HTML5', 'icon' => '🏗️'],
        ['name' => 'CSS3', 'icon' => '🎨'],
        ['name' => 'JavaScript', 'icon' => '⚡'],
        ['name' => 'Vue.js', 'icon' => '💚'],
        ['name' => 'React', 'icon' => '⚛️'],
        ['name' => 'Tailwind CSS', 'icon' => '🌊'],
        ['name' => 'Livewire', 'icon' => '🔥'],
        ['name' => 'Responsive Design', 'icon' => '📱'],
        ['name' => 'Performance', 'icon' => '📊'],
        ['name' => 'UI/UX Principles', 'icon' => '🎯'],
    ];

    $aiSkills = [
        ['title' => 'AI-Assisted Programming', 'desc' => 'Expert use of Claude, ChatGPT, and GitHub Copilot to accelerate development — writing precise, context-rich prompts that yield production-ready code.'],
        ['title' => 'Prompt Engineering', 'desc' => 'Deep understanding of prompt structure: system roles, few-shot examples, chain-of-thought reasoning, and iterative refinement to get optimal AI outputs.'],
        ['title' => 'AI Workflow Integration', 'desc' => 'Seamlessly integrating AI tools into the SDLC — from ideation and architecture design to code review, testing, and documentation generation.'],
        ['title' => 'LLM API Usage', 'desc' => 'Building features powered by LLM APIs (OpenAI, Anthropic) — including context management, function calling, and response streaming.'],
    ];

    $checkUrl = function (string $url): string {
        $key = 'project_status_' . md5($url);
        return \Illuminate\Support\Facades\Cache::remember($key, now()->addMinutes(5), function () use ($url): string {
            try {
                $response = \Illuminate\Support\Facades\Http::timeout(5)
                    ->withoutVerifying()
                    ->head($url);
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
            'tags'   => ['Laravel', 'MySQL', 'Vue.js', 'Tailwind CSS'],
            'desc'   => 'A centralized university portal serving as the digital gateway for Bicol University — consolidating academic resources, announcements, and institutional services into a single unified platform.',
            'year'   => '2025',
            'status' => $checkUrl('https://ibu.bicol-u.edu.ph'),
        ],
        [
            'title'  => 'ICTO — Content Management & Service Request System',
            'url'    => 'https://icto.bicol-u.edu.ph',
            'tags'   => ['Laravel', 'Livewire', 'MySQL', 'Tailwind CSS'],
            'desc'   => 'A dual-purpose platform for the BU ICT Office — featuring a full CMS for managing web content and an integrated service request system that streamlines IT support ticketing and request tracking across offices.',
            'year'   => '2024',
            'status' => $checkUrl('https://icto.bicol-u.edu.ph'),
        ],
        [
            'title'  => 'Survey — Clientele Satisfaction System',
            'url'    => 'https://survey.bicol-u.edu.ph',
            'tags'   => ['Laravel', 'Vue.js', 'MySQL', 'Chart.js'],
            'desc'   => 'An online survey platform that measures clientele satisfaction across all university offices. Supports configurable questionnaires per office, real-time response analytics, and exportable reports for quality assurance.',
            'year'   => '2023',
            'status' => $checkUrl('https://survey.bicol-u.edu.ph'),
        ],
        [
            'title'  => 'GASS — Financial Monitoring & Claims System',
            'url'    => 'https://gass.bicol-u.edu.ph',
            'tags'   => ['Laravel', 'MySQL', 'Livewire', 'Alpine.js'],
            'desc'   => 'A financial monitoring system for the General Administrative & Support Services office — automating claims processing, budget tracking, expenditure monitoring, and generating financial compliance reports.',
            'year'   => '2022',
            'status' => $checkUrl('https://gass.bicol-u.edu.ph'),
        ],
    ];

    $tags = ['Motivated', 'Creative', 'Problem Solver', 'Team Player', 'Adaptable', 'Passionate', 'Detail-Oriented', 'Continuous Learner'];
@endphp

<body class="bg-[#FAFAFA] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white font-sans antialiased">

    {{-- ── Navigation ──────────────────────────────────────────────────────── --}}
    <header class="fixed top-0 left-0 right-0 z-50 bg-[#FAFAFA]/80 dark:bg-[#0a0a0a]/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800">
        <nav class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="#hero" class="text-lg font-bold tracking-tight">
                <span class="text-[#DC2626]">EL</span><span class="text-[#1b1b18] dark:text-white">.</span>
            </a>
            <ul class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-600 dark:text-gray-400">
                <li><a href="#about"    class="nav-link hover:text-[#DC2626] transition">About</a></li>
                <li><a href="#ai"       class="nav-link hover:text-[#DC2626] transition">AI Skills</a></li>
                <li><a href="#skills"   class="nav-link hover:text-[#DC2626] transition">Skills</a></li>
                <li><a href="#projects" class="nav-link hover:text-[#DC2626] transition">Projects</a></li>
                <li><a href="#contact"  class="nav-link hover:text-[#DC2626] transition">Contact</a></li>
            </ul>
            <a href="#contact"
               class="hidden md:inline-flex items-center gap-2 bg-[#DC2626] text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-[#B91C1C] transition">
                Hire Me
            </a>
            {{-- Mobile menu toggle (simple) --}}
            <button id="menu-toggle" class="md:hidden text-gray-600 dark:text-gray-400 focus:outline-none" aria-label="Toggle menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </nav>
        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 dark:border-gray-800 bg-[#FAFAFA] dark:bg-[#0a0a0a] px-6 py-4 space-y-3 text-sm font-medium">
            <a href="#about"    class="block hover:text-[#DC2626] transition" onclick="document.getElementById('mobile-menu').classList.add('hidden')">About</a>
            <a href="#ai"       class="block hover:text-[#DC2626] transition" onclick="document.getElementById('mobile-menu').classList.add('hidden')">AI Skills</a>
            <a href="#skills"   class="block hover:text-[#DC2626] transition" onclick="document.getElementById('mobile-menu').classList.add('hidden')">Skills</a>
            <a href="#projects" class="block hover:text-[#DC2626] transition" onclick="document.getElementById('mobile-menu').classList.add('hidden')">Projects</a>
            <a href="#contact"  class="block hover:text-[#DC2626] transition" onclick="document.getElementById('mobile-menu').classList.add('hidden')">Contact</a>
        </div>
    </header>

    {{-- ── Hero ─────────────────────────────────────────────────────────────── --}}
    <section id="hero" class="min-h-screen flex items-center pt-20">
        <div class="max-w-6xl mx-auto px-6 py-20 w-full">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                {{-- Text --}}
                <div class="space-y-8 section-fade">
                    <div class="inline-flex items-center gap-2 bg-[#DC2626]/10 text-[#DC2626] text-xs font-semibold px-3 py-1.5 rounded-full">
                        <span class="w-2 h-2 bg-[#DC2626] rounded-full animate-pulse"></span>
                        Available for opportunities
                    </div>
                    <div class="space-y-4">
                        <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                            Full-Stack Developer
                        </p>
                        <h1 class="text-5xl lg:text-6xl font-bold leading-tight">
                            Hi, I'm <span class="gradient-text">Exequiel<br>Lustan</span>
                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-lg leading-relaxed">
                            I craft <strong class="text-[#1b1b18] dark:text-white">elegant web applications</strong> with a focus on clean code, performance, and exceptional user experience — supercharged with AI-assisted development.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="#projects"
                           class="inline-flex items-center gap-2 bg-[#DC2626] text-white font-semibold px-6 py-3 rounded-lg hover:bg-[#B91C1C] transition-all duration-200 shadow-lg shadow-[#DC2626]/25">
                            View My Work
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <a href="#contact"
                           class="inline-flex items-center gap-2 border border-gray-200 dark:border-gray-700 text-[#1b1b18] dark:text-white font-semibold px-6 py-3 rounded-lg hover:border-[#DC2626] hover:text-[#DC2626] transition-all duration-200">
                            Let's Talk
                        </a>
                    </div>
                    {{-- Social links --}}
                    <div class="flex items-center gap-4 pt-2">
                        <span class="text-xs text-gray-400 uppercase tracking-widest">Find me on</span>
                        <div class="flex gap-3">
                            <a href="https://github.com/neon2027" target="_blank" rel="noopener noreferrer"
                               aria-label="GitHub" class="w-9 h-9 rounded-lg border border-gray-200 dark:border-gray-700 flex items-center justify-center hover:border-[#DC2626] hover:text-[#DC2626] transition text-gray-500">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                                </svg>
                            </a>
                            <a href="https://www.linkedin.com/in/exequiel-lustan-19b610281/" target="_blank" rel="noopener noreferrer"
                               aria-label="LinkedIn" class="w-9 h-9 rounded-lg border border-gray-200 dark:border-gray-700 flex items-center justify-center hover:border-[#DC2626] hover:text-[#DC2626] transition text-gray-500">
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
                        <div class="absolute -inset-4 bg-linear-to-br from-[#DC2626]/20 to-purple-500/10 rounded-2xl blur-xl"></div>
                        <div class="relative">
                            <img src="{{ asset('assets/illustrations/portfolio.jpg') }}"
                                 alt="Exequiel Lustan — Full-Stack Developer"
                                 class="w-72 h-72 lg:w-80 lg:h-80 object-cover rounded-2xl shadow-2xl border-4 border-white dark:border-gray-800"/>
                            {{-- Floating badge --}}
                            <div class="absolute -bottom-4 -left-4 bg-white dark:bg-[#1a1a1a] border border-gray-100 dark:border-gray-700 rounded-xl px-4 py-2.5 shadow-lg">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 ai-badge rounded-lg flex items-center justify-center text-white text-sm">✨</div>
                                    <div>
                                        <p class="text-xs font-bold text-[#1b1b18] dark:text-white">AI-Powered Dev</p>
                                        <p class="text-xs text-gray-400">Prompt Engineering</p>
                                    </div>
                                </div>
                            </div>
                            {{-- Experience badge --}}
                            <div class="absolute -top-4 -right-4 bg-[#DC2626] text-white rounded-xl px-4 py-2.5 shadow-lg">
                                <p class="text-xl font-bold">4+</p>
                                <p class="text-xs opacity-90">Years Exp.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Scroll indicator --}}
            <div class="flex justify-center mt-20">
                <a href="#about" class="flex flex-col items-center gap-1 text-gray-400 hover:text-[#DC2626] transition">
                    <span class="text-xs uppercase tracking-widest">Scroll</span>
                    <svg class="w-4 h-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ── About ────────────────────────────────────────────────────────────── --}}
    <section id="about" class="py-24 bg-white dark:bg-[#111]">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="section-fade space-y-6">
                    <div>
                        <p class="text-sm font-semibold text-[#DC2626] uppercase tracking-widest mb-2">About Me</p>
                        <h2 class="text-4xl font-bold">Turning ideas into<br><span class="gradient-text">digital reality</span></h2>
                    </div>
                    <blockquote class="border-l-4 border-[#DC2626] pl-5 text-gray-600 dark:text-gray-400 leading-relaxed italic">
                        "I believe great software is the intersection of clean engineering and thoughtful design. I don't just write code — I architect solutions that scale."
                    </blockquote>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        I'm a passionate full-stack developer based in Legazpi City, Philippines, with a Master's in Information Systems. I specialize in <strong class="text-[#1b1b18] dark:text-white">Laravel & Vue.js</strong> applications and have a growing edge in AI-assisted development workflows.
                    </p>
                    <div class="flex flex-wrap gap-2 pt-2">
                        @foreach($tags as $tag)
                            <span class="text-xs font-semibold bg-[#DC2626]/10 text-[#DC2626] px-3 py-1.5 rounded-full">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>
                <div class="section-fade grid grid-cols-2 gap-4">
                    @foreach([
                        ['label' => 'Projects Delivered', 'value' => '6', 'icon' => ''],
                        ['label' => 'Years Experience',   'value' => '4+',  'icon' => ''],
                        ['label' => 'Technologies',       'value' => '15+', 'icon' => ''],
                        ['label' => 'Happy Clients',      'value' => '10+', 'icon' => ''],
                    ] as $stat)
                        <div class="card-hover bg-[#FAFAFA] dark:bg-[#1a1a1a] border border-gray-100 dark:border-gray-800 rounded-2xl p-6 text-center">
                            <div class="text-3xl mb-2">{{ $stat['icon'] }}</div>
                            <div class="text-3xl font-bold text-[#DC2626]">{{ $stat['value'] }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ── AI Skills ────────────────────────────────────────────────────────── --}}
    <section id="ai" class="py-24 bg-[#FAFAFA] dark:bg-[#0a0a0a]">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16 section-fade">
                <p class="text-sm font-semibold text-[#DC2626] uppercase tracking-widest mb-2">Competitive Edge</p>
                <h2 class="text-4xl font-bold mb-4">AI-Augmented <span class="gradient-text">Development</span></h2>
                <p class="text-gray-600 dark:text-gray-400">
                    I don't just use AI tools — I <strong class="text-[#1b1b18] dark:text-white">master</strong> them. My expertise in prompt engineering and AI workflows lets me deliver in hours what traditionally takes days.
                </p>
            </div>

            {{-- Featured AI banner --}}
            <div class="section-fade mb-10">
                <div class="relative overflow-hidden rounded-2xl ai-badge p-8 md:p-12 text-white">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-4 right-4 w-64 h-64 rounded-full bg-white blur-3xl"></div>
                        <div class="absolute -bottom-8 -left-8 w-48 h-48 rounded-full bg-white blur-2xl"></div>
                    </div>
                    <div class="relative grid md:grid-cols-2 gap-8 items-center">
                        <div class="space-y-4">
                            <div class="inline-flex items-center gap-2 bg-white/20 text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                                ✨ Signature Skill
                            </div>
                            <h3 class="text-3xl font-bold">AI-Assisted Programming</h3>
                            <p class="text-white/80 leading-relaxed">
                                I leverage Claude, ChatGPT, and GitHub Copilot with expert-level prompting techniques — chain-of-thought, few-shot examples, system personas, and structured outputs — to produce clean, production-ready code at unprecedented speed.
                            </p>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach(['Claude AI', 'ChatGPT', 'GitHub Copilot', 'OpenAI API', 'Anthropic API', 'Cursor IDE'] as $tool)
                                <div class="bg-white/15 backdrop-blur-sm border border-white/20 rounded-xl px-4 py-2.5 text-sm font-semibold text-center">
                                    {{ $tool }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-fade grid md:grid-cols-2 gap-6">
                @foreach($aiSkills as $skill)
                    <div class="card-hover bg-white dark:bg-[#111] border border-gray-100 dark:border-gray-800 rounded-2xl p-6">
                        <div class="w-10 h-10 bg-[#DC2626]/10 rounded-xl flex items-center justify-center text-[#DC2626] text-xl mb-4">✦</div>
                        <h3 class="text-base font-bold mb-2 text-[#1b1b18] dark:text-white">{{ $skill['title'] }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $skill['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Technical Skills ─────────────────────────────────────────────────── --}}
    <section id="skills" class="py-24 bg-white dark:bg-[#111]">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16 section-fade">
                <p class="text-sm font-semibold text-[#DC2626] uppercase tracking-widest mb-2">Technical Arsenal</p>
                <h2 class="text-4xl font-bold">Skills & <span class="gradient-text">Technologies</span></h2>
            </div>

            <div class="section-fade grid md:grid-cols-2 gap-12">
                {{-- Backend --}}
                <div class="space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-[#DC2626]/10 rounded-lg flex items-center justify-center text-[#DC2626]">⚙️</div>
                        <h3 class="font-bold uppercase tracking-wider text-sm">Backend Development</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($backendSkills as $skill)
                            <span class="skill-tag flex items-center gap-1.5 border border-dashed border-[#DC2626]/50 text-sm px-3.5 py-2 rounded-lg hover:bg-[#DC2626]/5 dark:hover:bg-[#DC2626]/10 cursor-default">
                                <span>{{ $skill['icon'] }}</span>
                                {{ $skill['name'] }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- Frontend --}}
                <div class="space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-[#DC2626]/10 rounded-lg flex items-center justify-center text-[#DC2626]">🎨</div>
                        <h3 class="font-bold uppercase tracking-wider text-sm">Frontend Development</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($frontendSkills as $skill)
                            <span class="skill-tag flex items-center gap-1.5 border border-dashed border-[#DC2626]/50 text-sm px-3.5 py-2 rounded-lg hover:bg-[#DC2626]/5 dark:hover:bg-[#DC2626]/10 cursor-default">
                                <span>{{ $skill['icon'] }}</span>
                                {{ $skill['name'] }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Projects ─────────────────────────────────────────────────────────── --}}
    <section id="projects" class="py-24 bg-[#FAFAFA] dark:bg-[#0a0a0a]">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-end justify-between mb-16 section-fade flex-wrap gap-4">
                <div>
                    <p class="text-sm font-semibold text-[#DC2626] uppercase tracking-widest mb-2">Portfolio</p>
                    <h2 class="text-4xl font-bold">Featured <span class="gradient-text">Projects</span></h2>
                </div>
                <p class="text-gray-500 dark:text-gray-400 text-sm max-w-xs text-right">
                    Real-world solutions built with modern technologies and AI-assisted workflows.
                </p>
            </div>

            <div class="section-fade grid md:grid-cols-2 gap-6">
                @foreach($projects as $project)
                    <article class="card-hover group bg-white dark:bg-[#111] border border-gray-100 dark:border-gray-800 rounded-2xl p-7 flex flex-col gap-4">
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
                            <h3 class="text-lg font-bold mb-1 group-hover:text-[#DC2626] transition">{{ $project['title'] }}</h3>
                            <a href="{{ $project['url'] }}" target="_blank" rel="noopener noreferrer"
                               class="text-xs text-gray-400 hover:text-[#DC2626] transition mb-2 inline-flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                {{ parse_url($project['url'], PHP_URL_HOST) }}
                            </a>
                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mt-2">{{ $project['desc'] }}</p>
                        </div>
                        <div class="flex flex-wrap gap-2 pt-2 border-t border-gray-100 dark:border-gray-800">
                            @foreach($project['tags'] as $tag)
                                <span class="text-xs font-medium bg-[#DC2626]/8 text-[#DC2626] px-2.5 py-1 rounded-md">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Education ────────────────────────────────────────────────────────── --}}
    <section id="education" class="py-24 bg-white dark:bg-[#111]">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16 section-fade">
                <p class="text-sm font-semibold text-[#DC2626] uppercase tracking-widest mb-2">Background</p>
                <h2 class="text-4xl font-bold">Education & <span class="gradient-text">Formation</span></h2>
            </div>
            <div class="section-fade max-w-2xl mx-auto space-y-6">
                @foreach([
                    [
                        'degree'  => 'Master in Information System',
                        'school'  => 'Bicol University',
                        'place'   => 'Legazpi City, Philippines',
                        'period'  => '2025 — Present',
                        'current' => true,
                    ],
                    [
                        'degree'  => 'B.S. Computer Science',
                        'school'  => 'Bicol University',
                        'place'   => 'Legazpi City, Philippines',
                        'period'  => '2018 — 2022',
                        'current' => false,
                    ],
                ] as $edu)
                    <div class="card-hover relative bg-[#FAFAFA] dark:bg-[#1a1a1a] border {{ $edu['current'] ? 'border-[#DC2626]/40' : 'border-gray-100 dark:border-gray-800' }} rounded-2xl p-6 flex gap-5 items-start">
                        @if($edu['current'])
                            <div class="absolute top-4 right-4 flex items-center gap-1.5 text-xs font-semibold text-[#DC2626]">
                                <span class="w-2 h-2 bg-[#DC2626] rounded-full animate-pulse"></span>
                                Current
                            </div>
                        @endif
                        <div class="w-12 h-12 rounded-xl {{ $edu['current'] ? 'bg-[#DC2626]' : 'bg-gray-100 dark:bg-gray-800' }} flex items-center justify-center text-{{ $edu['current'] ? 'white' : 'gray-500' }} text-xl shrink-0">
                            🎓
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">{{ $edu['degree'] }}</h3>
                            <p class="font-semibold text-[#DC2626] text-sm">{{ $edu['school'] }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $edu['place'] }}</p>
                            <p class="text-xs text-gray-400 mt-1 italic">{{ $edu['period'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Contact ───────────────────────────────────────────────────────────── --}}
    <section id="contact" class="py-24 bg-[#FAFAFA] dark:bg-[#0a0a0a]">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16 items-start">
                {{-- Left info --}}
                <div class="section-fade space-y-8">
                    <div>
                        <p class="text-sm font-semibold text-[#DC2626] uppercase tracking-widest mb-2">Get In Touch</p>
                        <h2 class="text-4xl font-bold mb-4">Let's build something <span class="gradient-text">great together</span></h2>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Whether you have a project in mind, a job opportunity, or just want to say hello — my inbox is always open. I'll get back to you within 24 hours.
                        </p>
                    </div>
                    <div class="space-y-4">
                        @foreach([
                            ['icon' => '📧', 'label' => 'Email', 'value' => 'lustanexequiel@gmail.com', 'href' => 'mailto:lustanexequiel@gmail.com'],
                            ['icon' => '📍', 'label' => 'Location', 'value' => 'Legazpi City, Philippines', 'href' => null],
                            ['icon' => '💼', 'label' => 'Status', 'value' => 'Open to opportunities', 'href' => null],
                        ] as $info)
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-[#DC2626]/10 rounded-xl flex items-center justify-center text-xl shrink-0">
                                    {{ $info['icon'] }}
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">{{ $info['label'] }}</p>
                                    @if($info['href'])
                                        <a href="{{ $info['href'] }}" class="font-semibold text-[#1b1b18] dark:text-white hover:text-[#DC2626] transition text-sm">
                                            {{ $info['value'] }}
                                        </a>
                                    @else
                                        <p class="font-semibold text-sm">{{ $info['value'] }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- Availability card --}}
                    <div class="bg-white dark:bg-[#111] border border-gray-100 dark:border-gray-800 rounded-2xl p-5">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></span>
                            <span class="font-bold text-sm">Currently Available</span>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            I'm open to full-time roles, freelance projects, and consulting engagements. Let's connect!
                        </p>
                    </div>
                </div>

                {{-- Contact form --}}
                <div class="section-fade">
                    <div class="bg-white dark:bg-[#111] border border-gray-100 dark:border-gray-800 rounded-2xl p-8 shadow-sm">
                        <h3 class="font-bold text-lg mb-6 text-[#1b1b18] dark:text-white">Send a Message</h3>
                        <livewire:contact-form/>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Footer ───────────────────────────────────────────────────────────── --}}
    <footer class="bg-white dark:bg-[#111] border-t border-gray-100 dark:border-gray-800 py-8">
        <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-gray-500 dark:text-gray-400">
            <p>
                &copy; {{ date('Y') }}
                <span class="font-semibold text-[#DC2626]">Exequiel Lustan</span>
                — Built with Laravel & Livewire
            </p>
            <p class="flex items-center gap-1">
                Crafted with <span class="text-[#DC2626]">♥</span> &amp; AI assistance
            </p>
        </div>
    </footer>

    @livewireScripts

    <script>
        // Mobile menu toggle
        document.getElementById('menu-toggle')?.addEventListener('click', () => {
            document.getElementById('mobile-menu')?.classList.toggle('hidden');
        });

        // Scroll-reveal observer
        const observer = new IntersectionObserver(
            (entries) => entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); }),
            { threshold: 0.12 }
        );
        document.querySelectorAll('.section-fade').forEach(el => observer.observe(el));

        // Active nav highlight on scroll
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('header a[href^="#"]');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(s => {
                if (window.scrollY >= s.offsetTop - 100) current = s.id;
            });
            navLinks.forEach(a => {
                a.classList.toggle('text-[#DC2626]', a.getAttribute('href') === '#' + current);
            });
        }, { passive: true });
    </script>
</body>
</html>
