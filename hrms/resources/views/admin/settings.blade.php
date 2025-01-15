@extends('admin.sidenav')

<section class="home-section" style="width: calc(100% - 58px); padding: 20px; overflow-y: auto;">
    
    <h2 style="">General Settings</h2>
    
    @if(session('success'))
        <div class="success-message">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="settings-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="system_name"><i class="fas fa-cogs"></i> System Name</label>
            <input type="text" id="system_name" name="system_name" value="{{ $settings->system_name }}" required>
        </div>

        <div class="form-group">
            <label for="theme"><i class="fas fa-palette"></i> Select Theme</label>
            <select id="theme" name="theme" onchange="changeTheme(this.value)">
                <option value="custom">Custom</option>
                <option value="light">Light Theme</option>
                <option value="dark">Dark Theme</option>
                <option value="blue">Blue Theme</option>
                <option value="agriculture">Department of Agriculture Theme</option>
                <option value="christmas">Christmas Theme</option>
                <option value="autumn">Autumn Theme</option>
                <option value="spring">Spring Theme</option>
                <option value="ocean">Ocean Theme</option>
                <option value="sunset">Sunset Theme</option>
                <option value="retro">Retro Theme</option>
                <option value="desert">Desert Theme</option>
                <option value="forest">Forest Theme</option>
                <option value="lavender">Lavender Theme</option>
                <option value="galaxy">Galaxy Theme</option>
                <option value="pastel">Pastel Theme</option>
                <option value="neon">Neon Theme</option>
                <option value="tropical">Tropical Theme</option>
                <option value="midnight">Midnight Theme</option>
                <option value="candy">Candy Theme</option>
                <option value="cyberpunk">Cyberpunk Theme</option>
                <option value="vintage">Vintage Theme</option>
                <option value="sunset_bliss">Sunset Bliss Theme</option>
                <option value="rainforest">Rainforest Theme</option>
                <option value="luxury">Luxury Theme</option>
                <option value="winter_wonderland">Winter Wonderland Theme</option>
                <option value="peachy">Peachy Theme</option>
            </select>
        </div>
        
        


        <div id="custom-colors" class="color-section" style="display: none;">
            <div class="form-group">
                <label for="main_color">Main Color</label>
                <input type="color" id="hidden_main_color" name="main_color" value="{{ $settings->main_color }}">
            </div>
            <div class="form-group">
                <label for="background_color">Background Color</label>
                <input type="color" id="hidden_background_color" name="background_color" value="{{ $settings->background_color }}">
            </div>
            <div class="form-group">
                <label for="text_color">Text Color</label>
                <input type="color" id="hidden_text_color" name="text_color" value="{{ $settings->text_color }}">
            </div>
            <div class="form-group">
                <label for="sidebar_bg_color">Sidebar Background Color</label>
                <input type="color" id="hidden_sidebar_bg_color" name="sidebar_bg_color" value="{{ $settings->sidebar_bg_color }}">
            </div>
            <div class="form-group">
                <label for="topbar_bg_color">Topbar Background Color</label>
                <input type="color" id="hidden_topbar_bg_color" name="topbar_bg_color" value="{{ $settings->topbar_bg_color }}">
            </div>
        </div>
        

        <div class="form-group">
            <label for="font_style"><i class="fas fa-text-height"></i> Font Style</label>
            <select id="font_style" name="font_style" required>
                <option value="Arial" {{ $settings->font_style == 'Arial' ? 'selected' : '' }}>Arial</option>
                <option value="Roboto" {{ $settings->font_style == 'Roboto' ? 'selected' : '' }}>Roboto</option>
                <option value="Open Sans" {{ $settings->font_style == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                <option value="Lato" {{ $settings->font_style == 'Lato' ? 'selected' : '' }}>Lato</option>
                <option value="Montserrat" {{ $settings->font_style == 'Montserrat' ? 'selected' : '' }}>Montserrat</option>
                <option value="Times New Roman" {{ $settings->font_style == 'Times New Roman' ? 'selected' : '' }}>Times New Roman</option>
                <option value="Georgia" {{ $settings->font_style == 'Georgia' ? 'selected' : '' }}>Georgia</option>
                <option value="Comic Sans MS" {{ $settings->font_style == 'Comic Sans MS' ? 'selected' : '' }}>Comic Sans MS</option>
                <option value="Courier New" {{ $settings->font_style == 'Courier New' ? 'selected' : '' }}>Courier New</option>
                <option value="Pacifico" {{ $settings->font_style == 'Pacifico' ? 'selected' : '' }}>Pacifico</option>
                <option value="Christmas" {{ $settings->font_style == 'Christmas' ? 'selected' : '' }}>Christmas (Festive)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="logo"><i class="fas fa-image"></i> Logo</label>
            <input type="file" id="logo" name="logo">
            @if($settings->logo)
                <img src="{{ asset('storage/'.$settings->logo) }}" alt="Logo" class="preview-logo">
            @endif
        </div>

        <button type="submit" class="submit-button"><i class="fas fa-save"></i> Update Settings</button>
    </form>

    <!-- Preview Section -->
    <h3>Preview</h3>
    <div id="preview-box">
        <h4>Sample System View</h4>
        <p>This is a preview of what your system will look like with the selected theme or custom colors.</p>
    </div>
</section>

<style>


    .submit-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .preview-logo {
        display: block;
        margin-top: 10px;
        max-width: 150px;
    }
    /* Success message */
    .success-message {
        background-color: #dff0d8;
        color: #3c763d;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    .success-message i {
        margin-right: 10px;
    }
    /* Preview box */
    #preview-box {
        background-color: #fff;
        padding: 15px;
        border-radius: 5px;
        margin-top: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    const previewBox = document.getElementById('preview-box');

    // Predefined theme colors
    const themes = {
        light: {
            mainColor: '#ffffff',
            backgroundColor: '#f7f9fc',
            textColor: '#333333',
            sidebarBgColor: '#f1f1f1',
            topbarBgColor: '#ffffff'
        },
        dark: {
            mainColor: '#333333',
            backgroundColor: '#121212',
            textColor: '#f7f9fc',
            sidebarBgColor: '#222222',
            topbarBgColor: '#333333'
        },
        blue: {
            mainColor: '#007bff',
            backgroundColor: '#e0f7ff',
            textColor: '#3fcdff',
            sidebarBgColor: '#2d66a1',
            topbarBgColor: '#007bff'
        },
        agriculture: {
            mainColor: '#FEAF00',
            backgroundColor: '#F5FFFA',
            textColor: '#000000',
            sidebarBgColor: '#228B22',
            topbarBgColor: '#228B22'
        },
        christmas: {  // Christmas theme colors
            mainColor: '#B22222',           // Christmas red
            backgroundColor: '#F5F5F5',     // Snowy white
            textColor: '#006400',           // Dark green
            sidebarBgColor: '#228B22',      // Green for sidebar
            topbarBgColor: '#B22222'        // Red for topbar
        },
        autumn: {  
            mainColor: '#D35400',          // Pumpkin orange
            backgroundColor: '#FFF5E6',    // Warm cream
            textColor: '#4D2C0F',          // Dark brown
            sidebarBgColor: '#A04000',     // Deep orange for sidebar
            topbarBgColor: '#D35400'       // Orange for topbar
        },
        spring: {  
            mainColor: '#77DD77',          // Soft green
            backgroundColor: '#FFFFE0',    // Light pastel yellow
            textColor: '#556B2F',          // Olive green
            sidebarBgColor: '#C1E1C1',     // Mint green for sidebar
            topbarBgColor: '#77DD77'       // Green for topbar
        },
        ocean: {  
            mainColor: '#4682B4',          // Steel blue
            backgroundColor: '#E0FFFF',    // Light cyan
            textColor: '#2F4F4F',          // Dark slate gray
            sidebarBgColor: '#5F9EA0',     // Cadet blue for sidebar
            topbarBgColor: '#4682B4'       // Steel blue for topbar
        },
        sunset: {  
            mainColor: '#FF4500',          // Orange-red
            backgroundColor: '#FFDAB9',    // Peach puff
            textColor: '#8B0000',          // Dark red
            sidebarBgColor: '#FF6347',     // Tomato for sidebar
            topbarBgColor: '#FF4500'       // Orange-red for topbar
        },
        retro: {  
            mainColor: '#FF69B4',          // Hot pink
            backgroundColor: '#FFFACD',    // Lemon chiffon
            textColor: '#8A2BE2',          // Blue violet
            sidebarBgColor: '#FFB6C1',     // Light pink for sidebar
            topbarBgColor: '#FF69B4'       // Hot pink for topbar
        },
        desert: {
            mainColor: '#C19A6B',         // Light brown
            backgroundColor: '#FFF5E1',   // Soft beige
            textColor: '#8B4513',         // Saddle brown
            sidebarBgColor: '#D2B48C',    // Tan
            topbarBgColor: '#C19A6B'      // Light brown
        },
        forest: {
            mainColor: '#556B2F',         // Olive green
            backgroundColor: '#F0FFF0',   // Honeydew
            textColor: '#2E8B57',         // Sea green
            sidebarBgColor: '#006400',    // Dark green
            topbarBgColor: '#556B2F'      // Olive green
        },
        lavender: {
            mainColor: '#E6E6FA',         // Lavender
            backgroundColor: '#F8F8FF',   // Ghost white
            textColor: '#4B0082',         // Indigo
            sidebarBgColor: '#9370DB',    // Medium purple
            topbarBgColor: '#E6E6FA'      // Lavender
        },
        galaxy: {
            mainColor: '#483D8B',         // Dark slate blue
            backgroundColor: '#1C1C1C',   // Jet black
            textColor: '#ADFF2F',         // Green-yellow
            sidebarBgColor: '#2F4F4F',    // Dark slate gray
            topbarBgColor: '#483D8B'      // Dark slate blue
        },
        pastel: {
            mainColor: '#FFD1DC',         // Pink pastel
            backgroundColor: '#FFF0F5',   // Lavender blush
            textColor: '#FF69B4',         // Hot pink
            sidebarBgColor: '#FFE4E1',    // Misty rose
            topbarBgColor: '#FFD1DC'      // Pink pastel
        },
        neon: {
            mainColor: '#39FF14',         // Neon green
            backgroundColor: '#0D0D0D',   // Almost black
            textColor: '#FF1493',         // Neon pink
            sidebarBgColor: '#FF4500',    // Neon orange
            topbarBgColor: '#39FF14'      // Neon green
        },
        tropical: {
            mainColor: '#FFA500',         // Orange
            backgroundColor: '#FFFACD',   // Lemon chiffon
            textColor: '#228B22',         // Forest green
            sidebarBgColor: '#20B2AA',    // Light sea green
            topbarBgColor: '#FFA500'      // Orange
        },
        midnight: {
            mainColor: '#191970',         // Midnight blue
            backgroundColor: '#0B0B45',   // Deep navy
            textColor: '#87CEEB',         // Sky blue
            sidebarBgColor: '#2E3B55',    // Dark slate
            topbarBgColor: '#191970'      // Midnight blue
        },
        candy: {
            mainColor: '#FF69B4',         // Hot pink
            backgroundColor: '#FFF0F5',   // Lavender blush
            textColor: '#FF6347',         // Tomato red
            sidebarBgColor: '#FFD700',    // Gold
            topbarBgColor: '#FF69B4'      // Hot pink
        },
        cyberpunk: {
            mainColor: '#00FFFF',         // Aqua
            backgroundColor: '#0D0D0D',   // Near black
            textColor: '#FF00FF',         // Magenta
            sidebarBgColor: '#333399',    // Dark purple
            topbarBgColor: '#00FFFF'      // Aqua
        },
        vintage: {
            mainColor: '#CD853F',         // Peru
            backgroundColor: '#FAF0E6',   // Linen
            textColor: '#8B4513',         // Saddle brown
            sidebarBgColor: '#D2B48C',    // Tan
            topbarBgColor: '#CD853F'      // Peru
        },
        sunset_bliss: {
            mainColor: '#FF4500',         // Orange-red
            backgroundColor: '#FFDAB9',   // Peach puff
            textColor: '#DC143C',         // Crimson
            sidebarBgColor: '#FFA07A',    // Light salmon
            topbarBgColor: '#FF4500'      // Orange-red
        },
        rainforest: {
            mainColor: '#006400',         // Dark green
            backgroundColor: '#F5FFFA',   // Mint cream
            textColor: '#2E8B57',         // Sea green
            sidebarBgColor: '#8FBC8F',    // Dark sea green
            topbarBgColor: '#006400'      // Dark green
        },
        luxury: {
            mainColor: '#DAA520',         // Goldenrod
            backgroundColor: '#1C1C1C',   // Jet black
            textColor: '#FFFFFF',         // White
            sidebarBgColor: '#8B4513',    // Saddle brown
            topbarBgColor: '#DAA520'      // Goldenrod
        },
        winter_wonderland: {
            mainColor: '#87CEEB',         // Sky blue
            backgroundColor: '#F0F8FF',   // Alice blue
            textColor: '#4682B4',         // Steel blue
            sidebarBgColor: '#ADD8E6',    // Light blue
            topbarBgColor: '#87CEEB'      // Sky blue
        },
        peachy: {
            mainColor: '#FFDAB9',         // Peach puff
            backgroundColor: '#FFF5EE',   // Seashell
            textColor: '#FF6347',         // Tomato
            sidebarBgColor: '#FFA07A',    // Light salmon
            topbarBgColor: '#FFDAB9'      // Peach puff
        },
    sunset_bliss: {
        mainColor: '#FF4500',         // Orange-red
        backgroundColor: '#FFDAB9',   // Peach puff
        textColor: '#DC143C',         // Crimson
        sidebarBgColor: '#FFA07A',    // Light salmon
        topbarBgColor: '#FF4500'      // Orange-red
    },
    rainforest: {
        mainColor: '#006400',         // Dark green
        backgroundColor: '#F5FFFA',   // Mint cream
        textColor: '#2E8B57',         // Sea green
        sidebarBgColor: '#8FBC8F',    // Dark sea green
        topbarBgColor: '#006400'      // Dark green
    },
    luxury: {
        mainColor: '#DAA520',         // Goldenrod
        backgroundColor: '#1C1C1C',   // Jet black
        textColor: '#FFFFFF',         // White
        sidebarBgColor: '#8B4513',    // Saddle brown
        topbarBgColor: '#DAA520'      // Goldenrod
    },
    winter_wonderland: {
        mainColor: '#87CEEB',         // Sky blue
        backgroundColor: '#F0F8FF',   // Alice blue
        textColor: '#4682B4',         // Steel blue
        sidebarBgColor: '#ADD8E6',    // Light blue
        topbarBgColor: '#87CEEB'      // Sky blue
    },
    peachy: {
        mainColor: '#FFDAB9',         // Peach puff
        backgroundColor: '#FFF5EE',   // Seashell
        textColor: '#FF6347',         // Tomato
        sidebarBgColor: '#FFA07A',    // Light salmon
        topbarBgColor: '#FFDAB9'      // Peach puff
    }



    };

    // Apply custom colors
    function applyCustomColors() {
        const mainColor = document.getElementById('main_color').value;
        const backgroundColor = document.getElementById('background_color').value;
        const textColor = document.getElementById('text_color').value;
        const sidebarBgColor = document.getElementById('sidebar_bg_color').value;
        const topbarBgColor = document.getElementById('topbar_bg_color').value;

        applyTheme({ mainColor, backgroundColor, textColor, sidebarBgColor, topbarBgColor });
    }

    // Apply selected theme
    function changeTheme(theme) {
    if (theme === 'custom') {
        document.getElementById('custom-colors').style.display = 'block';
        applyCustomColors();
    } else {
        document.getElementById('custom-colors').style.display = 'none';
        const selectedTheme = themes[theme];
        applyTheme(selectedTheme);
    }
}


    // Apply colors to the preview and update hidden fields for form submission
    function applyTheme(colors) {
        previewBox.style.setProperty('--main-color', colors.mainColor);
        previewBox.style.setProperty('--background-color', colors.backgroundColor);
        previewBox.style.setProperty('--text-color', colors.textColor);
        previewBox.style.setProperty('--sidebar-bg-color', colors.sidebarBgColor);
        previewBox.style.setProperty('--topbar-bg-color', colors.topbarBgColor);

        document.documentElement.style.setProperty('--main-color', colors.mainColor);
        document.documentElement.style.setProperty('--background-color', colors.backgroundColor);
        document.documentElement.style.setProperty('--text-color', colors.textColor);
        document.documentElement.style.setProperty('--sidebar-bg-color', colors.sidebarBgColor);
        document.documentElement.style.setProperty('--topbar-bg-color', colors.topbarBgColor);

        // Update hidden input fields with the selected values
        document.getElementById('hidden_main_color').value = colors.mainColor;
        document.getElementById('hidden_background_color').value = colors.backgroundColor;
        document.getElementById('hidden_text_color').value = colors.textColor;
        document.getElementById('hidden_sidebar_bg_color').value = colors.sidebarBgColor;
        document.getElementById('hidden_topbar_bg_color').value = colors.topbarBgColor;
    }

    // Initialize with custom colors
    changeTheme('custom');
</script>

<style>
    :root {
        --main-color: {{ $settings->main_color }};
        --background-color: {{ $settings->background_color }};
        --text-color: {{ $settings->text_color }};
        --sidebar-bg-color: {{ $settings->sidebar_bg_color }};
        --topbar-bg-color: {{ $settings->topbar_bg_color }};
        --font-style: '{{ $settings->font_style }}', sans-serif;
    }

    #preview-box {
        background-color: var(--background-color);
        color: var(--text-color);
        border: 1px solid var(--main-color);
        padding: 20px;
        margin-top: 20px;
    }

    h4 {
        color: var(--main-color);
    }

    button {
        background-color: var(--main-color);
        border-color: var(--main-color);
    }
</style>
