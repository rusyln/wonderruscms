<?php global $Wcms ?>

<!DOCTYPE html>
<html lang="<?= $Wcms->getSiteLanguage() ?>" class="scroll-smooth">
<head>
  <!-- Encoding, browser compatibility, viewport -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- SEO: WonderCMS data -->
  <meta name="title" content="<?= $Wcms->get('config', 'siteTitle') ?> - <?= $Wcms->page('title') ?>" />
  <meta name="description" content="<?= $Wcms->page('description') ?>">
  <meta name="keywords" content="<?= $Wcms->page('keywords') ?>">
  <meta property="og:url" content="<?= $this->url() ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="<?= $Wcms->get('config', 'siteTitle') ?>" />
  <meta property="og:title" content="<?= $Wcms->page('title') ?>" />
  <meta name="twitter:site" content="<?= $this->url() ?>" />
  <meta name="twitter:title" content="<?= $Wcms->get('config', 'siteTitle') ?> - <?= $Wcms->page('title') ?>" />
  <meta name="twitter:description" content="<?= $Wcms->page('description') ?>" />

  <!-- Website and page title -->
  <title><?= $Wcms->get('config', 'siteTitle') ?> - <?= $Wcms->page('title') ?></title>

  <!-- Admin CSS -->
  <?= $Wcms->css() ?>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'], mono: ['JetBrains Mono', 'monospace'] },
          colors: {
            green: { 500: '#00ff88', 600: '#00cc70', 700: '#009955' },
            dark: '#0a0e17',
            card: 'rgba(15, 23, 42, 0.6)',
          }
        }
      }
    }
  </script>

  <!-- Alpine.js + Icons -->
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&family=JetBrains+Mono&display=swap');
    body { background: #0a0e17; color: #e2e8f0; }
    .glass { backdrop-filter: blur(16px); background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(0, 255, 136, 0.2); }
    .glow { box-shadow: 0 0 30px rgba(0, 255, 136, 0.15); }
    .link-hover:hover { color: #00ff88; transition: color 0.3s; }
  </style>

  <?= $Wcms->get('head') ?>
</head>

<body class="antialiased" x-data="portfolio()" x-init="loadProjects()">
  <!-- Admin settings panel and alerts -->
  <?= $Wcms->settings() ?>

  <?= $Wcms->alerts() ?>

  <!-- Top navigation using WonderCMS menu -->
  <header class="fixed top-0 left-0 right-0 z-40 bg-dark/80 backdrop-blur border-b border-green-500/10">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
      <a href="<?= $this->url('/') ?>" class="text-sm md:text-base font-mono text-green-400 tracking-widest">
        <?= $Wcms->get('config', 'siteTitle') ?>
      </a>
      <nav>
        <ul class="flex flex-wrap gap-4 text-xs md:text-sm">
          <?= $Wcms->menu() ?>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Main WonderCMS page content (recommended placement) -->
  <main class="max-w-4xl mx-auto px-6 pt-28 pb-12">
    <?= $Wcms->page('content') ?>
  </main>

  <!-- Hero -->
  <section id="hero" class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-green-900/20 via-transparent to-purple-900/10"></div>
    <div class="relative text-center px-6 z-10">
      <h1 class="text-6xl md:text-8xl font-extrabold tracking-tight">
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-green-400">R4TKN</span>
      </h1>
      <p class="mt-6 text-2xl md:text-3xl font-light text-gray-300">
        IoT • Embedded Systems • Hardware Design • Firmware
      </p>
      <p class="mt-12 text-lg max-w-2xl mx-auto text-gray-400">
        I design cyber-physical systems that live at the edge — from battery-powered sensors in Antarctica to high-speed automotive ECUs.
      </p>
      <div class="mt-12 flex flex-wrap justify-center gap-6">
        <a href="#projects" class="px-8 py-4 bg-green-500 hover:bg-green-400 text-black font-semibold rounded-full transition transform hover:-translate-y-1 glow">
          View Projects
        </a>
        <a href="#contact" class="px-8 py-4 border border-green-500 text-green-400 hover:bg-green-500/10 rounded-full transition">
          Get in Touch
        </a>
      </div>
    </div>
  </section>

  <!-- Projects -->
  <section id="projects" class="py-24 px-6">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-5xl font-bold text-center mb-16 bg-gradient-to-r from-white to-green-400 bg-clip-text text-transparent">
        Featured Projects
      </h2>

      <!-- CMS: Add button (visible only when admin mode) -->
      <div x-show="isAdmin" class="text-center mb-10">
        <button @click="openForm()" class="px-6 py-3 bg-green-600 hover:bg-green-500 text-black rounded-lg font-medium">
          <i class="fas fa-plus mr-2"></i> Add Project
        </button>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <template x-for="p in projects" :key="p.id">
          <article class="glass rounded-2xl overflow-hidden hover:glow transition-all duration-500 hover:-translate-y-2">
            <div class="h-48 bg-gradient-to-br from-green-900/40 to-slate-900 flex items-center justify-center">
              <i class="fas fa-microchip text-6xl text-green-500/30"></i>
            </div>
            <div class="p-8">
              <h3 class="text-2xl font-bold text-white mb-3" x-text="p.title"></h3>
              <p class="text-gray-400 mb-6" x-text="p.desc"></p>
              <div class="flex flex-wrap gap-2 mb-6">
                <template x-for="tag in p.tags">
                  <span class="px-4 py-1 bg-green-900/30 text-green-400 rounded-full text-sm" x-text="tag"></span>
                </template>
              </div>
              <div class="flex gap-6 text-sm">
                <a :href="p.demo" target="_blank" class="text-green-400 link-hover"><i class="fas fa-external-link-alt mr-1"></i> Live</a>
                <a :href="p.code" target="_blank" class="text-green-400 link-hover"><i class="fab fa-github mr-1"></i> Code</a>
                <template x-if="isAdmin">
                  <div class="ml-auto flex gap-3">
                    <button @click="edit(p)" class="text-yellow-400"><i class="fas fa-edit"></i></button>
                    <button @click="remove(p.id)" class="text-red-400"><i class="fas fa-trash"></i></button>
                  </div>
                </template>
              </div>
            </div>
          </article>
        </template>
      </div>
    </div>
  </section>

  <!-- About -->
  <section id="about" class="py-24 px-6 bg-slate-900/30">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-5xl font-bold mb-10 bg-gradient-to-r from-white to-green-400 bg-clip-text text-transparent">About</h2>
      <p class="text-xl leading-relaxed text-gray-300">
        Full-stack embedded engineer with 8+ years shipping production IoT devices, automotive controllers, and wearables.
        Passionate about clean schematics, power-optimized firmware, and building things that survive real-world abuse.
      </p>

      <!-- Static editable block, same on each page -->
      <div class="mt-10 text-sm text-gray-400">
        <?= $Wcms->block('subside') ?>
      </div>

      <div class="mt-12 flex justify-center gap-10 text-3xl">
        <a href="https://github.com/r4tkn" target="_blank" class="text-green-400 link-hover"><i class="fab fa-github"></i></a>
        <a href="https://linkedin.com/in/r4tkn" target="_blank" class="text-green-400 link-hover"><i class="fab fa-linkedin"></i></a>
        <a href="mailto:hello@r4tkn.com" class="text-green-400 link-hover"><i class="fas fa-envelope"></i></a>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section id="contact" class="py-24 px-6 text-center">
    <h2 class="text-5xl font-bold mb-8 bg-gradient-to-r from-white to-green-400 bg-clip-text text-transparent">
      Let's Build Something
    </h2>
    <p class="text-xl text-gray-400 mb-12 max-w-2xl mx-auto">
      Available for consulting, contract work, or just nerding out about BLE mesh networks at 2 AM.
    </p>
    <a href="mailto:hello@r4tkn.com" class="inline-block px-12 py-5 bg-green-500 hover:bg-green-400 text-black text-xl font-bold rounded-full transition transform hover:scale-105 glow">
      hello@r4tkn.com
    </a>
  </section>

  <!-- Footer -->
  <footer class="py-8 text-center text-gray-500 text-sm border-t border-green-500/10">
    <?= $Wcms->footer() ?>
    <div class="mt-2">
      © 2025 R4TKN • Built with WonderCMS, Tailwind, Alpine and too much coffee
    </div>
  </footer>

  <!-- ADMIN MODE: Press Ctrl + Alt + K -->
  <div @keydown.window.ctrl.alt.k="isAdmin = !isAdmin; if(isAdmin) alert('Admin mode activated')" class="hidden"></div>

  <!-- Project Form Modal -->
  <div x-show="showForm" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-6" @click.away="closeForm()">
    <div class="glass max-w-2xl w-full p-10 rounded-2xl" @click.stop>
      <h3 class="text-3xl font-bold mb-8 text-green-400" x-text="editing ? 'Edit Project' : 'New Project'"></h3>
      <input x-model="form.title" placeholder="Title" class="w-full bg-slate-900 border border-green-500/30 rounded-lg px-5 py-4 mb-4 focus:outline-none focus:border-green-400">
      <textarea x-model="form.desc" placeholder="Description" class="w-full bg-slate-900 border border-green-500/30 rounded-lg px-5 py-4 mb-4 h-32"></textarea>
      <input x-model="form.tags" placeholder="Tags (comma separated)" class="w-full bg-slate-900 border border-green-500/30 rounded-lg px-5 py-4 mb-4">
      <input x-model="form.demo" placeholder="Live demo URL" class="w-full bg-slate-900 border border-green-500/30 rounded-lg px-5 py-4 mb-4">
      <input x-model="form.code" placeholder="GitHub / source URL" class="w-full bg-slate-900 border border-green-500/30 rounded-lg px-5 py-4 mb-8">
      <div class="flex gap-4">
        <button @click="save()" class="flex-1 py-4 bg-green-500 hover:bg-green-400 text-black font-bold rounded-lg">Save</button>
        <button @click="closeForm()" class="flex-1 py-4 border border-gray-600 hover:bg-gray-800 rounded-lg">Cancel</button>
      </div>
    </div>
  </div>

  <!-- Alpine Logic -->
  <script>
    function portfolio() {
      return {
        isAdmin: false,
        showForm: false,
        editing: null,
        projects: [],
        form: { title:'', desc:'', tags:'', demo:'', code:'' },

        loadProjects() {
          this.projects = JSON.parse(localStorage.getItem('r4tkn_projects_v2') || '[]');
          if (this.projects.length === 0) {
            this.projects = [
              {id:1, title:"Smart Factory Edge Gateway", desc:"Industrial IoT gateway with MQTT, OPC-UA, and 10-year battery life", tags:["C","FreeRTOS","LoRa","LTE-M"], demo:"https://demo.example.com", code:"https://github.com/r4tkn/gateway"},
              {id:2, title:"Wearable Health Monitor", desc:"Low-power nRF52840 device with PPG, ECG, and secure cloud sync", tags:["Zephyr","BLE","KiCad"], demo:"#", code:"https://github.com/r4tkn/wearable"},
              {id:3, title:"Automotive Radar Prototype", desc:"24 GHz FMCW radar module for ADAS research", tags:["STM32H7","FPGA","Radar"], demo:"#", code:"#"}
            ];
            this.save();
          }
        },

        openForm(project = null) {
          this.editing = project;
          if (project) {
            this.form = {title:project.title, desc:project.desc, tags:project.tags.join(', '), demo:project.demo, code:project.code};
          } else {
            this.form = {title:'', desc:'', tags:'', demo:'', code:''};
          }
          this.showForm = true;
        },

        closeForm() {
          this.showForm = false;
          this.editing = null;
        },

        save() {
          const tags = this.form.tags.split(',').map(t=>t.trim()).filter(Boolean);
          const data = {
            id: this.editing ? this.editing.id : Date.now(),
            title: this.form.title,
            desc: this.form.desc,
            tags,
            demo: this.form.demo || '#',
            code: this.form.code || '#'
          };

          if (this.editing) {
            const i = this.projects.findIndex(p => p.id === this.editing.id);
            this.projects[i] = data;
          } else {
            this.projects.unshift(data);
          }

          localStorage.setItem('r4tkn_projects_v2', JSON.stringify(this.projects));
          this.closeForm();
        },

        remove(id) {
          if (confirm('Delete this project?')) {
            this.projects = this.projects.filter(p => p.id !== id);
            localStorage.setItem('r4tkn_projects_v2', JSON.stringify(this.projects));
          }
        }
      }
    }
  </script>

  <!-- Admin JavaScript. More JS libraries can be added below -->
  <?= $Wcms->js() ?>

</body>
</html>
