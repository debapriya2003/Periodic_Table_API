<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
<title>Periodic Table API - Developer Documentation</title>

<!-- Model Viewer for 3D GLB -->
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

<style>
:root {
    --primary: #2563eb;
    --primary-dark: #1e40af;
    --secondary: #10b981;
    --bg: #f8fafc;
    --card: #ffffff;
    --text: #1e293b;
    --text-muted: #64748b;
    --border: #e2e8f0;
    --code-bg: #1e293b;
    --code-text: #e2e8f0;
    --success: #10b981;
    --error: #ef4444;
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    background: var(--bg);
    color: var(--text);
    line-height: 1.6;
}

/* Header */
header {
    background: linear-gradient(135deg, #1e40af 0%, #2563eb 50%, #3b82f6 100%);
    color: white;
    padding: 4rem 2rem;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

header h1 {
    font-size: 3rem;
    margin-bottom: 1rem;
    font-weight: 700;
}

header p {
    font-size: 1.25rem;
    max-width: 800px;
    margin: 0 auto 2rem;
    opacity: 0.95;
}

.version-badge {
    display: inline-block;
    background: rgba(255,255,255,0.2);
    padding: 0.5rem 1rem;
    border-radius: 999px;
    font-size: 0.9rem;
    backdrop-filter: blur(10px);
}

/* Container */
.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
}

/* Section Styling */
.section {
    background: var(--card);
    border-radius: 12px;
    padding: 2.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    border: 1px solid var(--border);
}

.section-title {
    font-size: 2rem;
    margin-bottom: 1.5rem;
    color: var(--primary);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.section-title::before {
    content: '';
    width: 4px;
    height: 2rem;
    background: var(--primary);
    border-radius: 2px;
}

/* Feature Grid */
.feature-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin: 2rem 0;
}

.feature-card {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    padding: 1.5rem;
    border-radius: 8px;
    border: 1px solid var(--border);
    transition: transform 0.2s, box-shadow 0.2s;
}

.feature-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.feature-card h3 {
    color: var(--primary);
    margin-bottom: 0.75rem;
    font-size: 1.25rem;
}

.feature-icon {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

/* Code Blocks */
.code-block {
    background: var(--code-bg);
    color: var(--code-text);
    padding: 1.5rem;
    border-radius: 8px;
    overflow-x: auto;
    position: relative;
    margin: 1rem 0;
    font-family: 'Courier New', monospace;
    font-size: 0.9rem;
    line-height: 1.5;
}

.copy-btn {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(255,255,255,0.1);
    color: white;
    border: 1px solid rgba(255,255,255,0.2);
    padding: 0.5rem 1rem;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.85rem;
    transition: all 0.2s;
}

.copy-btn:hover {
    background: rgba(255,255,255,0.2);
}

.copy-btn.copied {
    background: var(--success);
    border-color: var(--success);
}

/* Endpoint Documentation */
.endpoint {
    background: var(--bg);
    padding: 1.5rem;
    border-radius: 8px;
    margin: 1rem 0;
    border-left: 4px solid var(--primary);
}

.endpoint-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.http-method {
    background: var(--secondary);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.85rem;
}

.endpoint-url {
    font-family: 'Courier New', monospace;
    background: white;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    border: 1px solid var(--border);
    flex: 1;
    min-width: 200px;
}

.param-table {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
}

.param-table th,
.param-table td {
    padding: 0.75rem;
    text-align: left;
    border-bottom: 1px solid var(--border);
}

.param-table th {
    background: var(--bg);
    font-weight: 600;
    color: var(--primary);
}

.param-table code {
    background: rgba(37, 99, 235, 0.1);
    padding: 0.2rem 0.5rem;
    border-radius: 4px;
    font-size: 0.9rem;
}

/* API Testing Area */
.test-controls {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-group label {
    font-weight: 600;
    color: var(--text);
    font-size: 0.9rem;
}

.form-group select,
.form-group input {
    padding: 0.75rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    font-size: 1rem;
    background: white;
    transition: border-color 0.2s;
}

.form-group select:focus,
.form-group input:focus {
    outline: none;
    border-color: var(--primary);
}

.btn {
    background: var(--primary);
    color: white;
    border: none;
    padding: 0.875rem 2rem;
    border-radius: 6px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
}

.btn:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(37, 99, 235, 0.3);
}

.btn:active {
    transform: translateY(0);
}

/* Output Areas */
.output-area {
    margin-top: 1.5rem;
    padding: 1.5rem;
    background: var(--bg);
    border-radius: 8px;
    border: 1px solid var(--border);
}

#jsonOutput {
    background: var(--code-bg);
    color: var(--code-text);
    padding: 1.5rem;
    border-radius: 8px;
    overflow-x: auto;
    font-family: 'Courier New', monospace;
    font-size: 0.9rem;
    line-height: 1.5;
    white-space: pre-wrap;
    max-height: 500px;
    overflow-y: auto;
}

/* Visual Output */
#visualOutput .element-card {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    border: 1px solid var(--border);
}

#visualOutput h2 {
    color: var(--primary);
    margin-bottom: 1rem;
    font-size: 2rem;
}

#visualOutput h3 {
    color: var(--primary);
    margin: 2rem 0 1rem;
    font-size: 1.5rem;
}

.property-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1rem;
    margin: 1.5rem 0;
}

.property-field {
    background: var(--bg);
    padding: 1rem;
    border-radius: 8px;
    border: 1px solid var(--border);
}

.property-field strong {
    display: block;
    color: var(--primary);
    margin-bottom: 0.5rem;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.property-field span {
    color: var(--text);
    font-size: 1.1rem;
}

.property-field .null {
    color: var(--text-muted);
    font-style: italic;
}

.element-image {
    width: 100%;
    max-width: 520px;
    height: auto;
    max-height: 420px;
    object-fit: contain;
    display: block;
    margin: 1.5rem auto;
    border-radius: 12px;
    background: #f9fafb;
    padding: 1rem;
    border: 1px solid var(--border);
}

.image-attribution {
    color: var(--text-muted);
    font-size: 0.85rem;
    text-align: center;
    margin-top: 0.5rem;
    font-style: italic;
}

model-viewer {
    width: 100%;
    height: 450px;
    background: #f1f5f9;
    border-radius: 12px;
    margin: 1rem 0;
}

/* Tabs */
.tabs {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid var(--border);
}

.tab {
    padding: 0.75rem 1.5rem;
    background: transparent;
    border: none;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-muted);
    border-bottom: 3px solid transparent;
    transition: all 0.2s;
}

.tab:hover {
    color: var(--primary);
}

.tab.active {
    color: var(--primary);
    border-bottom-color: var(--primary);
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

/* Loading State */
.loading {
    text-align: center;
    padding: 2rem;
    color: var(--text-muted);
}

.loading::after {
    content: '...';
    animation: dots 1.5s steps(4, end) infinite;
}

@keyframes dots {
    0%, 20% { content: '.'; }
    40% { content: '..'; }
    60%, 100% { content: '...'; }
}

/* Responsive Design */
@media (max-width: 768px) {
    header h1 {
        font-size: 2rem;
    }
    
    header p {
        font-size: 1rem;
    }
    
    .section {
        padding: 1.5rem;
    }
    
    .section-title {
        font-size: 1.5rem;
    }
    
    .test-controls {
        grid-template-columns: 1fr;
    }
    
    .endpoint-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .property-grid {
        grid-template-columns: 1fr;
    }
}

/* Scrollbar Styling */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: var(--bg);
}

::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--text-muted);
}
</style>
</head>
<body>

<header>
    <h1>🧪 Periodic Table API</h1>
    <p>A comprehensive, educational, and developer-friendly REST API providing detailed information about all 119 chemical elements, including 3D models, images, and complete atomic data.</p>
    <span class="version-badge">v1.0 • Free & Open Source • JSON Format</span>
</header>

<div class="container">

    <!-- Introduction Section -->
    <section class="section">
        <h2 class="section-title">Introduction & Use Cases</h2>
        
        <p style="font-size: 1.1rem; margin-bottom: 1.5rem;">
            The Periodic Table API is a robust, production-ready RESTful web service that provides programmatic access to comprehensive data about chemical elements. Built on top of a meticulously curated JSON dataset, this API serves both educational and professional development purposes.
        </p>

        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon">📚</div>
                <h3>Educational Applications</h3>
                <p>Build interactive chemistry learning platforms, virtual laboratories, and educational games. Perfect for schools, universities, and online learning platforms.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🔬</div>
                <h3>Scientific Research Tools</h3>
                <p>Integrate element data into research applications, molecular modeling software, and chemical analysis tools. Access atomic properties, electron configurations, and physical characteristics.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">💻</div>
                <h3>Developer Projects</h3>
                <p>Power mobile apps, web applications, data visualization projects, and API mashups. RESTful architecture ensures easy integration with any programming language.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🎨</div>
                <h3>Interactive Visualizations</h3>
                <p>Create stunning periodic table interfaces with 3D Bohr models, spectral images, and real element photographs. Includes GLB 3D models for WebGL/AR/VR applications.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h3>Mobile Applications</h3>
                <p>Build native iOS and Android apps with offline support. Lightweight JSON responses ensure fast performance even on mobile networks.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🌐</div>
                <h3>International Projects</h3>
                <p>Support multilingual chemistry education with standardized element symbols and nomenclature. Data includes historical discoverers and naming information.</p>
            </div>
        </div>

        <h3 style="margin-top: 2rem; margin-bottom: 1rem; font-size: 1.5rem;">Key Features</h3>
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 0.5rem 0; display: flex; align-items: start;">
                <span style="color: var(--success); margin-right: 0.75rem; font-size: 1.25rem;">✓</span>
                <span><strong>Complete Element Data:</strong> All 119 elements including synthetic elements up to Oganesson (118) and Ununennium (119)</span>
            </li>
            <li style="padding: 0.5rem 0; display: flex; align-items: start;">
                <span style="color: var(--success); margin-right: 0.75rem; font-size: 1.25rem;">✓</span>
                <span><strong>Rich Media Assets:</strong> 2D Bohr models, 3D GLB models, spectral images, and real element photographs</span>
            </li>
            <li style="padding: 0.5rem 0; display: flex; align-items: start;">
                <span style="color: var(--success); margin-right: 0.75rem; font-size: 1.25rem;">✓</span>
                <span><strong>Comprehensive Properties:</strong> Atomic mass, electron configuration, ionization energies, electronegativity, density, melting/boiling points, and more</span>
            </li>
            <li style="padding: 0.5rem 0; display: flex; align-items: start;">
                <span style="color: var(--success); margin-right: 0.75rem; font-size: 1.25rem;">✓</span>
                <span><strong>Flexible Querying:</strong> Search by element name, symbol, atomic number, period, group, or category</span>
            </li>
            <li style="padding: 0.5rem 0; display: flex; align-items: start;">
                <span style="color: var(--success); margin-right: 0.75rem; font-size: 1.25rem;">✓</span>
                <span><strong>RESTful Design:</strong> Standard HTTP methods, JSON responses, proper status codes, and CORS support</span>
            </li>
            <li style="padding: 0.5rem 0; display: flex; align-items: start;">
                <span style="color: var(--success); margin-right: 0.75rem; font-size: 1.25rem;">✓</span>
                <span><strong>No Authentication Required:</strong> Completely free and open access for all developers</span>
            </li>
        </ul>
    </section>

    <!-- API Documentation Section -->
    <section class="section">
        <h2 class="section-title">API Endpoint Documentation</h2>
        
        <p style="margin-bottom: 2rem; font-size: 1.05rem;">
            Base URL: <code style="background: rgba(37, 99, 235, 0.1); padding: 0.25rem 0.75rem; border-radius: 4px; font-size: 1rem;">https://coddoc.xyz/ptapi/api.php</code>
        </p>

        <!-- Get All Elements -->
        <div class="endpoint">
            <div class="endpoint-header">
                <span class="http-method">GET</span>
                <code class="endpoint-url">https://coddoc.xyz/ptapi/api.php?all=true</code>
            </div>
            <p style="margin-bottom: 1rem;"><strong>Description:</strong> Retrieves all 119 elements in the periodic table with complete data for each element.</p>
            
            <p><strong>Response Format:</strong></p>
            <div class="code-block">
                <button class="copy-btn" onclick="copyCode(this)">Copy</button>
<pre>{
  "count": 119,
  "elements": [
    {
      "name": "Hydrogen",
      "symbol": "H",
      "number": 1,
      "atomic_mass": 1.008,
      "category": "diatomic nonmetal",
      "period": 1,
      "group": 1,
      ...
    }
  ]
}</pre>
            </div>

            <p><strong>Use Cases:</strong> Full periodic table displays, data exports, offline applications, comprehensive analysis.</p>
        </div>

        <!-- Get Single Element -->
        <div class="endpoint">
            <div class="endpoint-header">
                <span class="http-method">GET</span>
                <code class="endpoint-url">https://coddoc.xyz/ptapi/api.php?element={value}</code>
            </div>
            <p style="margin-bottom: 1rem;"><strong>Description:</strong> Retrieves detailed information about a specific element by name, symbol, or atomic number.</p>
            
            <table class="param-table">
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Examples</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>element</code></td>
                        <td>string/integer</td>
                        <td>Element name, symbol, or atomic number (case-insensitive)</td>
                        <td><code>Oxygen</code>, <code>O</code>, <code>8</code></td>
                    </tr>
                </tbody>
            </table>

            <p><strong>Example Requests:</strong></p>
            <div class="code-block">
                <button class="copy-btn" onclick="copyCode(this)">Copy</button>
<pre>// By name
api.php?element=Oxygen

// By symbol
api.php?element=Fe

// By atomic number
api.php?element=79</pre>
            </div>

            <p><strong>Response Format:</strong></p>
            <div class="code-block">
                <button class="copy-btn" onclick="copyCode(this)">Copy</button>
<pre>{
  "name": "Oxygen",
  "symbol": "O",
  "number": 8,
  "atomic_mass": 15.999,
  "appearance": null,
  "category": "diatomic nonmetal",
  "phase": "Gas",
  "period": 2,
  "group": 16,
  "block": "p",
  "electron_configuration": "1s2 2s2 2p4",
  "electron_affinity": 140.976,
  "electronegativity_pauling": 3.44,
  "ionization_energies": [1313.9, 3388.3, ...],
  "density": 1.429,
  "melt": 54.36,
  "boil": 90.188,
  "molar_heat": null,
  "discovered_by": "Carl Wilhelm Scheele",
  "named_by": "Antoine Lavoisier",
  "shells": [2, 6],
  "image": {
    "url": "https://...",
    "title": "...",
    "attribution": "..."
  },
  "bohr_model_image": "https://...",
  "bohr_model_3d": "https://...glb",
  "spectral_img": "https://...",
  "summary": "Oxygen is a chemical element..."
}</pre>
            </div>
        </div>

        <!-- Get by Period -->
        <div class="endpoint">
            <div class="endpoint-header">
                <span class="http-method">GET</span>
                <code class="endpoint-url">https://coddoc.xyz/ptapi/api.php?period={number}</code>
            </div>
            <p style="margin-bottom: 1rem;"><strong>Description:</strong> Retrieves all elements from a specific period (horizontal row) of the periodic table.</p>
            
            <table class="param-table">
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Range</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>period</code></td>
                        <td>integer</td>
                        <td>1-8</td>
                        <td>Period number (1 = first row, 7 = seventh row, 8 = hypothetical eighth row)</td>
                    </tr>
                </tbody>
            </table>

            <p><strong>Example:</strong> <code>https://coddoc.xyz/ptapi/api.php?period=2</code> returns H, He, Li, Be, B, C, N, O, F, Ne</p>
        </div>

        <!-- Get by Group -->
        <div class="endpoint">
            <div class="endpoint-header">
                <span class="http-method">GET</span>
                <code class="endpoint-url">https://coddoc.xyz/ptapi/api.php?group={number}</code>
            </div>
            <p style="margin-bottom: 1rem;"><strong>Description:</strong> Retrieves all elements from a specific group (vertical column) of the periodic table.</p>
            
            <table class="param-table">
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Range</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>group</code></td>
                        <td>integer</td>
                        <td>1-18</td>
                        <td>Group number (1 = alkali metals, 18 = noble gases)</td>
                    </tr>
                </tbody>
            </table>

            <p><strong>Example:</strong> <code>https://coddoc.xyz/ptapi/api.php?group=17</code> returns all halogens (F, Cl, Br, I, At, Ts)</p>
        </div>

        <!-- Get by Type/Category -->
        <div class="endpoint">
            <div class="endpoint-header">
                <span class="http-method">GET</span>
                <code class="endpoint-url">https://coddoc.xyz/ptapi/api.php?type={category}</code>
            </div>
            <p style="margin-bottom: 1rem;"><strong>Description:</strong> Retrieves all elements of a specific chemical category or type.</p>
            
            <table class="param-table">
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>type</code></td>
                        <td>string</td>
                        <td>Element category (case-insensitive)</td>
                    </tr>
                </tbody>
            </table>

            <p><strong>Available Categories:</strong></p>
            <ul style="list-style: none; padding: 0; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 0.5rem; margin: 1rem 0;">
                <li style="background: var(--bg); padding: 0.5rem; border-radius: 4px;">• alkali metal</li>
                <li style="background: var(--bg); padding: 0.5rem; border-radius: 4px;">• alkaline earth metal</li>
                <li style="background: var(--bg); padding: 0.5rem; border-radius: 4px;">• transition metal</li>
                <li style="background: var(--bg); padding: 0.5rem; border-radius: 4px;">• post-transition metal</li>
                <li style="background: var(--bg); padding: 0.5rem; border-radius: 4px;">• metalloid</li>
                <li style="background: var(--bg); padding: 0.5rem; border-radius: 4px;">• diatomic nonmetal</li>
                <li style="background: var(--bg); padding: 0.5rem; border-radius: 4px;">• polyatomic nonmetal</li>
                <li style="background: var(--bg); padding: 0.5rem; border-radius: 4px;">• noble gas</li>
                <li style="background: var(--bg); padding: 0.5rem; border-radius: 4px;">• lanthanide</li>
                <li style="background: var(--bg); padding: 0.5rem; border-radius: 4px;">• actinide</li>
            </ul>

            <p><strong>Example:</strong> <code>api.php?type=noble%20gas</code> returns He, Ne, Ar, Kr, Xe, Rn, Og</p>
        </div>

        <!-- Error Responses -->
        <div style="background: rgba(239, 68, 68, 0.1); padding: 1.5rem; border-radius: 8px; border-left: 4px solid var(--error); margin-top: 2rem;">
            <h3 style="margin-bottom: 1rem; color: var(--error);">Error Responses</h3>
            
            <p><strong>404 Not Found:</strong> Element not found</p>
            <div class="code-block">
<pre>{ "error": "Element not found" }</pre>
            </div>

            <p style="margin-top: 1rem;"><strong>400 Bad Request:</strong> Invalid query parameters</p>
            <div class="code-block">
<pre>{ "error": "Invalid API request" }</pre>
            </div>

            <p style="margin-top: 1rem;"><strong>500 Internal Server Error:</strong> Server-side issue</p>
            <div class="code-block">
<pre>{ "error": "pt.json not found" }</pre>
            </div>
        </div>
    </section>

    <!-- API Testing Section -->
    <section class="section">
        <h2 class="section-title">API Testing Playground</h2>
        
        <p style="margin-bottom: 2rem; font-size: 1.05rem;">
            Test the API endpoints in real-time and see both JSON responses and visual renderings. Select a query type, enter parameters, and click "Execute API Call" to see the results.
        </p>

        <div class="tabs">
            <button class="tab active" onclick="switchTab('json')">JSON Output</button>
            <button class="tab" onclick="switchTab('visual')">Visual Output</button>
        </div>

        <!-- Testing Controls -->
        <div class="test-controls">
            <div class="form-group">
                <label for="queryType">Query Type</label>
                <select id="queryType" onchange="updateQueryForm()">
                    <option value="all">Get All Elements</option>
                    <option value="element">Get Single Element</option>
                    <option value="period">Get by Period</option>
                    <option value="group">Get by Group</option>
                    <option value="type">Get by Category/Type</option>
                </select>
            </div>

            <div class="form-group" id="valueGroup">
                <label for="queryValue" id="valueLabel">Element (name/symbol/number)</label>
                <input type="text" id="queryValue" placeholder="e.g., Oxygen, Fe, 8">
            </div>

            <div class="form-group" style="align-items: flex-end;">
                <button class="btn" onclick="executeQuery()">Execute API Call</button>
            </div>
        </div>

        <!-- Tab Content: JSON Output -->
        <div id="jsonTab" class="tab-content active">
            <div class="output-area">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <h3 style="margin: 0;">JSON Response</h3>
                    <button class="copy-btn" onclick="copyJSON()" style="position: static;">Copy JSON</button>
                </div>
                <pre id="jsonOutput">// API response will appear here</pre>
            </div>
        </div>

        <!-- Tab Content: Visual Output -->
        <div id="visualTab" class="tab-content">
            <div class="output-area">
                <h3 style="margin-bottom: 1rem;">Visual Rendering</h3>
                <div id="visualOutput">
                    <p style="color: var(--text-muted); text-align: center; padding: 2rem;">
                        Execute an API call to see the visual representation
                    </p>
                </div>
            </div>
        </div>
    </section>
<div  style="align-items: flex-end;">
                <a class="btn" href="PeriodicTable.html">Execute API Call</a>
            </div>
</div>
<footer style="background: var(--code-bg); color: white; padding: 3rem 2rem; text-align: center; margin-top: 4rem;">
    <p style="margin-bottom: 0.5rem; font-size: 1.1rem;">Built for students, educators, and developers</p>
    <p style="opacity: 0.7; font-size: 0.9rem;">Periodic Table API • Created by Debapriya Mukherjee</p>
    <p style="opacity: 0.5; font-size: 0.85rem; margin-top: 1rem;">Free & Open Source • MIT License</p>
</footer>

<script>
// Copy code functionality
function copyCode(btn) {
    const codeBlock = btn.parentElement.querySelector('pre').textContent;
    navigator.clipboard.writeText(codeBlock).then(() => {
        btn.textContent = 'Copied!';
        btn.classList.add('copied');
        setTimeout(() => {
            btn.textContent = 'Copy';
            btn.classList.remove('copied');
        }, 2000);
    });
}

// Copy JSON functionality
function copyJSON() {
    const jsonText = document.getElementById('jsonOutput').textContent;
    if (jsonText && jsonText !== '// API response will appear here') {
        navigator.clipboard.writeText(jsonText).then(() => {
            alert('JSON copied to clipboard!');
        });
    }
}

// Tab switching
function switchTab(tabName) {
    // Update tab buttons
    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
    });
    event.target.classList.add('active');

    // Update tab content
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
    });
    document.getElementById(tabName + 'Tab').classList.add('active');
}

// Update query form based on selection
function updateQueryForm() {
    const queryType = document.getElementById('queryType').value;
    const valueGroup = document.getElementById('valueGroup');
    const valueLabel = document.getElementById('valueLabel');
    const valueInput = document.getElementById('queryValue');

    if (queryType === 'all') {
        valueGroup.style.display = 'none';
    } else {
        valueGroup.style.display = 'flex';
        
        switch(queryType) {
            case 'element':
                valueLabel.textContent = 'Element (name/symbol/number)';
                valueInput.placeholder = 'e.g., Oxygen, Fe, 8';
                break;
            case 'period':
                valueLabel.textContent = 'Period Number (1-8)';
                valueInput.placeholder = 'e.g., 2';
                break;
            case 'group':
                valueLabel.textContent = 'Group Number (1-18)';
                valueInput.placeholder = 'e.g., 17';
                break;
            case 'type':
                valueLabel.textContent = 'Category/Type';
                valueInput.placeholder = 'e.g., noble gas, alkali metal';
                break;
        }
    }
}

// Execute API query
async function executeQuery() {
    const queryType = document.getElementById('queryType').value;
    const queryValue = document.getElementById('queryValue').value.trim();
    const jsonOutput = document.getElementById('jsonOutput');
    const visualOutput = document.getElementById('visualOutput');

    // Build URL
    let url = 'api.php?';
    if (queryType === 'all') {
        url += 'all=true';
    } else {
        if (!queryValue) {
            alert('Please enter a value for your query');
            return;
        }
        url += `${queryType}=${encodeURIComponent(queryValue)}`;
    }

    // Show loading
    jsonOutput.textContent = 'Loading...';
    visualOutput.innerHTML = '<p class="loading">Loading</p>';

    try {
        const response = await fetch(url);
        const data = await response.json();

        // Display JSON
        jsonOutput.textContent = JSON.stringify(data, null, 2);

        // Display Visual
        renderVisual(data, queryType);

    } catch (error) {
        jsonOutput.textContent = 'Error: ' + error.message;
        visualOutput.innerHTML = `<p style="color: var(--error); text-align: center; padding: 2rem;">Error loading data: ${error.message}</p>`;
    }
}

// Render visual output
function renderVisual(data, queryType) {
    const visualOutput = document.getElementById('visualOutput');

    // Handle errors
    if (data.error) {
        visualOutput.innerHTML = `<p style="color: var(--error); text-align: center; padding: 2rem;">${data.error}</p>`;
        return;
    }

    // Handle multiple elements
    if (data.elements && Array.isArray(data.elements)) {
        if (data.elements.length === 0) {
            visualOutput.innerHTML = '<p style="text-align: center; padding: 2rem;">No elements found</p>';
            return;
        }

        let html = `<div style="margin-bottom: 1.5rem;">
            <h3>Found ${data.count || data.elements.length} element(s)</h3>
            ${data.period ? `<p>Period: ${data.period}</p>` : ''}
            ${data.group ? `<p>Group: ${data.group}</p>` : ''}
            ${data.type ? `<p>Category: ${data.type}</p>` : ''}
        </div>`;

        // Show first element in detail, list others
        html += renderElement(data.elements[0]);

        if (data.elements.length > 1) {
            html += `<div style="margin-top: 2rem; padding: 1.5rem; background: var(--bg); border-radius: 8px;">
                <h3 style="margin-bottom: 1rem;">Other Elements in This ${queryType === 'period' ? 'Period' : queryType === 'group' ? 'Group' : 'Category'}:</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem;">`;
            
            for (let i = 1; i < data.elements.length; i++) {
                const el = data.elements[i];
                html += `<div style="background: white; padding: 1rem; border-radius: 8px; text-align: center; border: 1px solid var(--border);">
                    <div style="font-size: 2rem; font-weight: bold; color: var(--primary);">${el.symbol}</div>
                    <div style="font-size: 0.9rem; color: var(--text-muted);">${el.number}</div>
                    <div style="font-size: 1rem; margin-top: 0.5rem;">${el.name}</div>
                </div>`;
            }
            html += `</div></div>`;
        }

        visualOutput.innerHTML = html;
        return;
    }

    // Handle single element
    visualOutput.innerHTML = renderElement(data);
}

// Render single element
function renderElement(el) {
    let html = `<div class="element-card">
        <h2>${el.name} (${el.symbol})</h2>
        <p style="font-size: 1.1rem; color: var(--text-muted); margin-bottom: 1.5rem;">
            Atomic Number: ${el.number} • ${el.category || 'Unknown category'}
        </p>`;

    // Main element image
    if (el.image && el.image.url) {
        html += `<img src="${el.image.url}" alt="${el.name}" class="element-image">`;
        if (el.image.attribution) {
            html += `<p class="image-attribution">${el.image.attribution}</p>`;
        }
    }

    // Bohr model 2D
    if (el.bohr_model_image) {
        html += `<h3>Bohr Model (2D)</h3>
            <img src="${el.bohr_model_image}" alt="${el.name} Bohr Model" class="element-image">`;
    }

    // Spectral image
    if (el.spectral_img) {
        html += `<h3>Spectral Image</h3>
            <img src="${el.spectral_img}" alt="${el.name} Spectrum" class="element-image">`;
    }

    // 3D Bohr model
    if (el.bohr_model_3d) {
        html += `<h3>Bohr Model (3D Interactive)</h3>
            <model-viewer src="${el.bohr_model_3d}" 
                auto-rotate 
                camera-controls 
                shadow-intensity="1"
                alt="${el.name} 3D Bohr Model">
            </model-viewer>`;
    }

    // Properties
    html += `<h3>Properties</h3><div class="property-grid">`;

    const excludeKeys = ['image', 'bohr_model_image', 'bohr_model_3d', 'spectral_img', 'summary', 'name', 'symbol', 'number'];
    
    for (const [key, value] of Object.entries(el)) {
        if (excludeKeys.includes(key)) continue;

        let display;
        if (value === null) {
            display = ' <a> <span style="display:inline-block;width:200px;white-space:normal;overflow-wrap:break-word;">null</span></a>';
        } else if (Array.isArray(value)) {
            display = value.join(', ');
        } else if (typeof value === 'object') {
            display = JSON.stringify(value);
        } else {
            display = value;
        }

        html += `<div class="property-field">
            <strong>${key.replace(/_/g, ' ')}</strong>
            <a> <span style="display:inline-block;width:200px;white-space:normal;overflow-wrap:break-word;">${display}</span></a>
        </div>`;
    }

    html += `</div>`;

    // Summary
    if (el.summary) {
        html += `<h3>Summary</h3>
            <p style="font-size: 1.05rem; line-height: 1.8;">${el.summary}</p>`;
    }

    html += `</div>`;
    return html;
}

// Initialize
updateQueryForm();
</script>

</body>

</html>