<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="YoIkc4bBr4HMTVCE0mT8tUfvbcyfI0xzAbtWc7DT">
    <title>Forest Management Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- External Libraries -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/6b3a5661a9.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js for graphs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Leaflet for maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Leaflet Marker Cluster -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    
    <!-- Custom styleSheet -->
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <!-- Loading Spinner -->
    <div class="loader" id="loader">
        <div class="spinner"></div>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-2">
                    <div class="logo-bg-container">
                        <img src="https://gis-lab.s3.ap-southeast-1.amazonaws.com/14efcc73-5a15-4fd6-98f9-052868aeb7eb_FWF_New_Logo.png"
                            alt="Department Logo" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-8">
                    <h1 class="header-title">Forest Management Dashboard</h1>
                </div>
                <div class="col-md-2 text-end">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cg%3E%3Ctree stroke='%23228B22' stroke-width='2' fill='%2332CD32'%3E%3Cpath d='M20 80 Q30 60 40 80 Q50 50 60 80 Q70 60 80 80' fill='%23228B22'/%3E%3Cpath d='M45 80 L55 80 L55 90 L45 90 Z' fill='%238B4513'/%3E%3C/tree%3E%3Ctext x='50' y='95' text-anchor='middle' font-size='8' fill='%23333'%3EForestry%3C/text%3E%3C/g%3E%3C/svg%3E"
                        alt="Forestry Icon" style="height: 50px;">
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="forestTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="plantation-tab" data-bs-toggle="tab" data-bs-target="#plantation"
                    type="button" role="tab">
                    <i class="fas fa-seedling me-2"></i>Forest Plantation Mapping
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="change-analysis-tab" data-bs-toggle="tab" data-bs-target="#change-analysis"
                    type="button" role="tab">
                    <i class="fas fa-chart-line me-2"></i>Forest Cover Change Analysis
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="forestTabContent">
            <!-- Forest Plantation Mapping Tab -->
            <div class="tab-pane fade show active" id="plantation" role="tabpanel">
                <!-- Filter Section -->
                <section class="filter-section">
                    <h2 class="filter-title">
                        <i class="fas fa-filter me-2"></i>Plantation Mapping Filters
                    </h2>
                    <div class="row">
                        <div class="col-lg-2 col-md-6 mb-3">
                            <label for="plantationZoneSel" class="form-label">Zone</label>
                            <select id="plantationZoneSel" class="form-select">
                                <option value="" selected>Select Zone</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6 mb-3">
                            <label for="plantationCircleSel" class="form-label">Circle</label>
                            <select id="plantationCircleSel" class="form-select" disabled>
                                <option value="" selected>Select zone first</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6 mb-3">
                            <label for="plantationDivisionSel" class="form-label">Division</label>
                            <select id="plantationDivisionSel" class="form-select" disabled>
                                <option value="" selected>Select circle first</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6 mb-3">
                            <label for="plantationForestSel" class="form-label">Forest</label>
                            <select id="plantationForestSel" class="form-select" disabled>
                                <option value="" selected>Select division first</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6 mb-3">
                            <label for="plantationYearSel" class="form-label">Year</label>
                            <select id="plantationYearSel" class="form-select">
                                <option value="" selected>Select Year</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6 mb-3">
                            <label for="plantationSchemeSel" class="form-label">Funding Source</label>
                            <select id="plantationSchemeSel" class="form-select">
                                <option value="" selected>Select Scheme</option>
                            </select>
                        </div>
                    </div>
                </section>

                <!-- Map Container -->
                <section class="content-container">
                    <div class="map-container" style="grid-column: 1 / -1;">
                        <h4 class="section-title">
                            <i class="fas fa-map me-2"></i>Plantation Geographic Overview
                        </h4>
                        <div id="plantationMap"></div>
                    </div>
                </section>

                <!-- Plantation Statistics -->
                <div class="stats-container mt-4">
                    <h4 class="section-title">
                        <i class="fas fa-chart-pie me-2"></i>Plantation Statistics
                    </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="plantsChart" style="height: 300px;"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="areaChart" style="height: 300px;"></div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Year</th>
                                            <th>Scheme</th>
                                            <th>Total Plants</th>
                                            <th>Total Area (acres)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="statsTableBody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Forest Cover Change Analysis Tab -->
            <div class="tab-pane fade" id="change-analysis" role="tabpanel">
                <!-- Filter Section -->
                <section class="filter-section">
                    <h2 class="filter-title">
                        <i class="fas fa-filter me-2"></i>Change Analysis Filters
                    </h2>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="changeZoneSel" class="form-label">Zone</label>
                            <select id="changeZoneSel" class="form-select">
                                <option value="" selected>Select Zone</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="changeCircleSel" class="form-label">Circle</label>
                            <select id="changeCircleSel" class="form-select" disabled>
                                <option value="" selected>Select zone first</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="changeDivisionSel" class="form-label">Division</label>
                            <select id="changeDivisionSel" class="form-select" disabled>
                                <option value="" selected>Select circle first</option>
                            </select>
                        </div>
                    </div>
                </section>

                <!-- Map and Chart Container -->
                <section class="content-container">
                    <!-- Map Container -->
                    <div class="map-container">
                        <h4 class="section-title">
                            <i class="fas fa-map me-2"></i>Geographic Overview
                        </h4>
                        <div id="map">
                            <div class="sidebar" id="spatialSidebar">
                                <div class="sidebar-header" onclick="toggleSidebar()">
                                    <div class="sidebar-title" id="sidebarTitle">
                                        <i class="fas fa-chart-area"></i>
                                        <span>Change Analysis</span>
                                    </div>
                                    <i class="fas fa-chevron-down" id="chevronIcon"></i>
                                </div>

                                <div class="layer-btn" id="sidebarContent">
                                    <div class="year-checkboxes">
                                        <label>
                                            <input type="checkbox" value="2023"
                                                onchange="drawYearLayers(this.checked, this.value)">
                                            2023
                                        </label>
                                        <label>
                                            <input type="checkbox" value="2025"
                                                onchange="drawYearLayers(this.checked, this.value)">
                                            2025
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Container -->
                    <div class="chart-container">
                        <h4 class="section-title">
                            <i class="fas fa-chart-bar me-2"></i>Forest Cover Change
                        </h4>
                        <div class="chart-wrapper">
                            <canvas id="lulcChart"></canvas>
                        </div>
                    </div>
                </section>

                <!-- Change Analysis Statistics Table -->
                <section class="stats-container mt-4">
                    <h4 class="section-title">
                        <i class="fas fa-table me-2"></i>Land Use Land Cover Statistics
                    </h4>
                    
                    <!-- Stats Table -->
                    <div class="stats-table" id="changeStatsTable" style="display: none;">
                        <table class="table table-bordered">
                            <thead class="table-success">
                                <!-- <tr>
                                    <th style="background: #16a34a; color: white; font-weight: 600;">Land Cover Type</th>
                                    <th id="changeStatsYearHeader" style="background: #16a34a; color: white; font-weight: 600;">Area (SQ. KM)</th>
                                </tr> -->
                            </thead>
                            <tbody id="changeStatsTableBody">
                            </tbody>
                        </table>
                    </div>

                    <!-- Summary Statistics Cards -->
                    <div class="row mt-3" id="changeSummaryCards" style="display: none;">
                        <div class="col-md-6">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Total Forest Cover</h5>
                                    <h3 id="changeTotalForestCover">0 Acre</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Total Area</h5>
                                    <h3 id="changeTotalArea">0 Acre</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>© GIS Lab, Forestry Wildlife and Fisheries Department, Lahore - Government of the Punjab.<br>
            All rights reserved.</p>
    </footer>

    <script>
        // ================================
        // GLOBAL VARIABLES
        // ================================
        
        // Maps
        let plantationMap, changeMap;
        
        // API URLs
        const API_BASE_URL = './spatialAPIs/';
        const STATS_API_BASE_URL = './statsAPIs/';
        
        // Plantation Tab Variables
        let plantationLayers = {
            zone: null,
            circle: null,
            division: null,
            forest: null
        };
        let currentPlantationData = null;
        let forestBoundariesLayer = null;
        let plantationMarkers = [];
        let schemeColors = {};
        
        // Change Analysis Tab Variables
        let changeLayers = {
            zone: null,
            circle: null,
            division: null,
            year23: null,
            year25: null
        };
        const cachedYearData = {};
        let cachedYearDataStat = {};
        let lulcChart;
        
        // Class colors for LULC
        const classColors = {
            "Tree Cover": "#009600CC",
            "Agriland/Grass": "#FFFF00F0",
            "Water": "#0000FFCC",
            "Barren Land": "#A0522DCC",
            "Builtup": "#FF0000CC",
        };

        // ================================
        // INITIALIZATION
        // ================================
        
        document.addEventListener('DOMContentLoaded', function () {
            initializeMaps();
            initializeLULCChart();
            setupEventListeners();
            loadZonesData();
        });

        // ================================
        // MAP INITIALIZATION
        // ================================
        
        function initializeMaps() {
            // Initialize plantation map
            plantationMap = L.map('plantationMap').setView([31.5204, 74.3587], 8);
            
            // Initialize change analysis map
            changeMap = L.map('map').setView([31.5204, 74.3587], 8);

            // Base layers for both maps
            const createBaseLayers = () => ({
                "Open Street Map": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }),
                "Google Streets": L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '© Google'
                }),
                "Google Satellite": L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '© Google'
                }),
                "Google Hybrid": L.tileLayer('http://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '© Google'
                })
            });

            // Add base layers to both maps
            const plantationBaseLayers = createBaseLayers();
            const changeBaseLayers = createBaseLayers();

            plantationBaseLayers["Open Street Map"].addTo(plantationMap);
            changeBaseLayers["Open Street Map"].addTo(changeMap);

            L.control.layers(plantationBaseLayers).addTo(plantationMap);
            L.control.layers(changeBaseLayers).addTo(changeMap);

            // Add interactive legend to change analysis map
                const legend = L.control({ position: 'bottomright' });
                legend.onAdd = function () {
                    const div = L.DomUtil.create('div', 'info legend');
                    for (const landClass in classColors) {
                        const color = classColors[landClass];
                        div.innerHTML +=
                            `<i style="background:${color}; width:12px; height:12px; display:inline-block; margin-right:6px; cursor:pointer;" 
                            onclick="toggleChartDataset('${landClass}')" title="Click to toggle"></i>${landClass}<br>`;
                    }
                    return div;
                };
                legend.addTo(changeMap);
            }

            // Function to toggle chart datasets when legend is clicked
            function toggleChartDataset(landClass) {
                if (!lulcChart) return;
                
                const datasets = lulcChart.data.datasets;
                const labelToKey = {
                    'Tree Cover': 'tree_cover',
                    'Agriland/Grass': 'agriland_grass',
                    'Water': 'water',
                    'Barren Land': 'barren_land',
                    'Builtup': 'builtup'
                };
                
                const key = labelToKey[landClass];
                if (!key) return;
                
                // Find the index of this land class in the labels
                const labelIndex = lulcChart.data.labels.indexOf(landClass);
                if (labelIndex === -1) return;
                
                // Toggle visibility for all datasets at this index
                datasets.forEach(dataset => {
                    const meta = lulcChart.getDatasetMeta(dataset.index || 0);
                    if (meta) {
                        meta.hidden = meta.hidden === null ? !lulcChart.data.datasets[dataset.index || 0].hidden : null;
                    }
                });
                
                lulcChart.update();
            }
        // ================================
        // CHART INITIALIZATION
        // ================================
        

        // Update the initializeLULCChart function with these options:
        function initializeLULCChart() {
            const ctx = document.getElementById('lulcChart').getContext('2d');
            lulcChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [], // Will contain land cover types
                    datasets: [] // Will be populated dynamically
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Forest Cover Change Analysis',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        },
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    size: 10
                                },
                                boxWidth: 12
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: ${context.parsed.y.toFixed(2)} acres`;
                                }
                            },
                            bodyFont: {
                                size: 10
                            }
                        },
                        // This plugin will show permanent labels on bars
                        datalabels: {
                            display: true,
                            color: '#000',
                            anchor: 'end',
                            align: 'top',
                            offset: 2,
                            font: {
                                size: 8,
                                weight: 'bold'
                            },
                            formatter: function(value) {
                                return value >= 1000 ? (value/1000).toFixed(1) + 'K' : value.toFixed(1);
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Land Cover Types',
                                font: {
                                    weight: 'bold',
                                    size: 10
                                }
                            },
                            ticks: {
                                font: {
                                    size: 9
                                }
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Area (acres)',
                                font: {
                                    weight: 'bold',
                                    size: 10
                                }
                            },
                            ticks: {
                                font: {
                                    size: 9
                                },
                                callback: function(value) {
                                    if (value >= 1000) {
                                        return (value / 1000).toFixed(0) + 'K';
                                    }
                                    return value;
                                }
                            },
                            beginAtZero: true
                        }
                    }
                },
                plugins: [ChartDataLabels] // Add this plugin
            });
        }

        // ================================
        // EVENT LISTENERS
        // ================================
        
        function setupEventListeners() {
            // Plantation tab event listeners
            setupPlantationEventListeners();
            
            // Change analysis tab event listeners
            setupChangeAnalysisEventListeners();

            // Tab change event
            const forestTabs = document.getElementById('forestTabs');
            if (forestTabs) {
                forestTabs.addEventListener('shown.bs.tab', function (event) {
                    setTimeout(() => {
                        if (event.target.id === 'plantation-tab') {
                            plantationMap.invalidateSize();
                        } else if (event.target.id === 'change-analysis-tab') {
                            changeMap.invalidateSize();
                        }
                    }, 100);
                });
            }
        }

        function setupPlantationEventListeners() {
            const plantationZoneSel = document.getElementById('plantationZoneSel');
            const plantationCircleSel = document.getElementById('plantationCircleSel');
            const plantationDivisionSel = document.getElementById('plantationDivisionSel');
            const plantationForestSel = document.getElementById('plantationForestSel');
            const plantationYearSel = document.getElementById('plantationYearSel');
            const plantationSchemeSel = document.getElementById('plantationSchemeSel');

            if (plantationZoneSel) {
                plantationZoneSel.addEventListener('change', function () {
                    handlePlantationZoneSelection(this.value);
                });
            }

            if (plantationCircleSel) {
                plantationCircleSel.addEventListener('change', function () {
                    handlePlantationCircleSelection(this.value);
                });
            }

            if (plantationDivisionSel) {
                plantationDivisionSel.addEventListener('change', function () {
                    handlePlantationDivisionSelection(this.value);
                });
            }

            if (plantationForestSel) {
                plantationForestSel.addEventListener('change', function () {
                    handlePlantationForestSelection(this.value);
                });
            }

            if (plantationYearSel) {
                plantationYearSel.addEventListener('change', function () {
                    filterAndDisplayPlantationData();
                });
            }

            if (plantationSchemeSel) {
                plantationSchemeSel.addEventListener('change', function () {
                    filterAndDisplayPlantationData();
                });
            }
        }

        function setupChangeAnalysisEventListeners() {
            const changeZoneSel = document.getElementById('changeZoneSel');
            const changeCircleSel = document.getElementById('changeCircleSel');
            const changeDivisionSel = document.getElementById('changeDivisionSel');

            if (changeZoneSel) {
                changeZoneSel.addEventListener('change', function () {
                    handleChangeZoneSelection(this.value);
                });
            }

            if (changeCircleSel) {
                changeCircleSel.addEventListener('change', function () {
                    handleChangeCircleSelection(this.value);
                });
            }

            if (changeDivisionSel) {
                changeDivisionSel.addEventListener('change', function () {
                    handleChangeDivisionSelection(this.value);
                });
            }
        }

        // ================================
        // DATA LOADING
        // ================================
        
        function loadZonesData() {
            showLoader();
            fetch(API_BASE_URL + 'fetch_zones.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Populate both zone dropdowns
                        populateDropdown('plantationZoneSel', data.data);
                        populateDropdown('changeZoneSel', data.data);
                    } else {
                        console.error('Error loading zones:', data.message);
                    }
                    hideLoader();
                })
                .catch(error => {
                    console.error('Error:', error);
                    hideLoader();
                });
        }

        function populateDropdown(dropdownId, data) {
            const dropdown = document.getElementById(dropdownId);
            if (!dropdown) return;

            // Clear existing options except the first one
            while (dropdown.options.length > 1) {
                dropdown.remove(1);
            }
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item;
                option.textContent = item;
                dropdown.appendChild(option);
            });
        }

        // ================================
        // PLANTATION TAB FUNCTIONALITY
        // ================================
        
        function handlePlantationZoneSelection(zone) {
            showLoader();
            
            // Reset dependent dropdowns
            resetDropdown(document.getElementById('plantationCircleSel'), 'Select Circle');
            resetDropdown(document.getElementById('plantationDivisionSel'), 'Select Division');
            resetDropdown(document.getElementById('plantationForestSel'), 'Select Forest');
            
            document.getElementById('plantationCircleSel').disabled = true;
            document.getElementById('plantationDivisionSel').disabled = true;
            document.getElementById('plantationForestSel').disabled = true;
            
            if (zone) {
                // Draw zone boundary and load data
                Promise.all([
                    drawBoundary(zone, 'zone', plantationMap, plantationLayers),
                    loadCirclesData(zone, 'plantation'),
                    loadPlantationData({ zone })
                ]).finally(() => hideLoader());
            } else {
                clearMapLayers('zone', plantationLayers, plantationMap);
                clearPlantationPoints();
                hideLoader();
            }
        }

        function handlePlantationCircleSelection(circle) {
            showLoader();
            
            resetDropdown(document.getElementById('plantationDivisionSel'), 'Select Division');
            resetDropdown(document.getElementById('plantationForestSel'), 'Select Forest');
            document.getElementById('plantationDivisionSel').disabled = true;
            document.getElementById('plantationForestSel').disabled = true;
            
            if (circle) {
                Promise.all([
                    drawBoundary(circle, 'circle', plantationMap, plantationLayers),
                    loadDivisionsData(circle, 'plantation'),
                    loadPlantationData({ 
                        zone: document.getElementById('plantationZoneSel').value,
                        circle: circle 
                    })
                ]).finally(() => hideLoader());
            } else {
                const zone = document.getElementById('plantationZoneSel').value;
                clearMapLayers('circle', plantationLayers, plantationMap);
                loadPlantationData({ zone }).finally(() => hideLoader());
            }
        }

        function handlePlantationDivisionSelection(division) {
            showLoader();
            
            resetDropdown(document.getElementById('plantationForestSel'), 'Select Forest');
            document.getElementById('plantationForestSel').disabled = true;
            
            if (division) {
                Promise.all([
                    drawBoundary(division, 'division', plantationMap, plantationLayers),
                    loadForestsData(division, 'plantation'),
                    loadPlantationData({
                        zone: document.getElementById('plantationZoneSel').value,
                        circle: document.getElementById('plantationCircleSel').value,
                        division: division
                    })
                ]).finally(() => hideLoader());
            } else {
                const zone = document.getElementById('plantationZoneSel').value;
                const circle = document.getElementById('plantationCircleSel').value;
                clearMapLayers('division', plantationLayers, plantationMap);
                loadPlantationData({ zone, circle }).finally(() => hideLoader());
            }
        }

        function handlePlantationForestSelection(forest) {
            showLoader();
            
            if (forest) {
                Promise.all([
                    drawForestBoundary(forest, plantationMap, plantationLayers),
                    loadPlantationData({
                        zone: document.getElementById('plantationZoneSel').value,
                        circle: document.getElementById('plantationCircleSel').value,
                        division: document.getElementById('plantationDivisionSel').value,
                        forest: forest
                    })
                ]).finally(() => hideLoader());
            } else {
                const zone = document.getElementById('plantationZoneSel').value;
                const circle = document.getElementById('plantationCircleSel').value;
                const division = document.getElementById('plantationDivisionSel').value;
                clearMapLayers('forest', plantationLayers, plantationMap);
                loadPlantationData({ zone, circle, division }).finally(() => hideLoader());
            }
        }

        function loadPlantationData(filters = {}) {
            showLoader();
            
            return fetch(`${API_BASE_URL}get_plantation.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(filters)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    currentPlantationData = data.data;
                    
                    const operations = [];
                    
                    // Add forest boundaries drawing to operations
                    if (data.data.forest_geojson?.length > 0) {
                        operations.push(new Promise(resolve => {
                            const forestFeatures = data.data.forest_geojson.map(forest => ({
                                type: 'Feature',
                                geometry: forest.geometry,
                                properties: {
                                    name: forest.forest_name,

                                }
                            }));
                            drawForestBoundaries(forestFeatures);
                            resolve();
                        }));
                    }
                    
                    // Add other operations
                    operations.push(
                        updateMapLegend([...new Set(data.data.raw_data.map(item => item.scheme_name))].filter(Boolean)),
                        displayPlantationPoints(data.data.raw_data),
                        updatePlantationDropdownOptions(data.data.raw_data),
                        updatePlantationStatistics(data.data.stats_summary)
                    );
                    
                    return Promise.all(operations);
                }
                return data;
            })
            .catch(error => {
                console.error('Error loading plantation data:', error);
                throw error;
            })
            .finally(() => {
                setTimeout(hideLoader, 300); // Small delay to ensure all layers are drawn
            });
        }

        function filterAndDisplayPlantationData() {
            const year = document.getElementById('plantationYearSel').value;
            const scheme = document.getElementById('plantationSchemeSel').value;

            if (!currentPlantationData) return;

            // Filter raw data
            let filteredData = currentPlantationData.raw_data;
            if (year) {
                filteredData = filteredData.filter(item => item.year.toString() === year);
            }
            if (scheme) {
                filteredData = filteredData.filter(item => item.scheme_name === scheme);
            }

            // Filter stats summary
            let filteredStats = currentPlantationData.stats_summary;
            if (year) {
                filteredStats = filteredStats.filter(item => item.year.toString() === year);
            }
            if (scheme) {
                filteredStats = filteredStats.filter(item => item.scheme_name === scheme);
            }

            // Update display
            displayPlantationPoints(filteredData);
            updatePlantationStatistics(filteredStats);
        }

        function displayPlantationPoints(points) {
            clearPlantationPoints();
            
            console.log('Displaying plantation points:', points ? points.length : 0);
            
            if (!points || points.length === 0) {
                console.log('No plantation points to display');
                showNoDataMessage();
                return;
            }
            
            hideNoDataMessage();
            
            let validPointsCount = 0;
            
            points.forEach(point => {
                if (point.latitude && point.longitude) {
                    const color = getSchemeColor(point.scheme_name);
                    const icon = createCustomIcon(color);
                    
                    const marker = L.marker([point.latitude, point.longitude], { 
                        icon: icon,
                        riseOnHover: true
                    });
                    
                    const popupContent = `
                        <div class="popup-content" style="min-width: 280px; font-family: Arial, sans-serif;">
                            <div style="background: linear-gradient(135deg, #f2f3f2ff, #a3a6a4ff); color: white; padding: 8px 12px; margin: -10px -10px 12px -10px; border-radius: 8px 8px 0 0;">
                                <h6 style="margin: 0; font-size: 14px; font-weight: 600;">
                                    <i class="fas fa-map-marker-alt" style="margin-right: 5px;"></i>
                                    ${point.forest_name || 'Unknown Location'}
                                </h6>
                            </div>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px 12px; font-size: 12px; margin-bottom: 10px;">
                                <div><strong style="color: #374151;">Zone:</strong><br><span style="color: #6b7280;">${point.f_zone || 'N/A'}</span></div>
                                <div><strong style="color: #374151;">Circle:</strong><br><span style="color: #6b7280;">${point.f_circle || 'N/A'}</span></div>
                                <div><strong style="color: #374151;">Division:</strong><br><span style="color: #6b7280;">${point.f_division || 'N/A'}</span></div>
                                <div><strong style="color: #374151;">Tehsil:</strong><br><span style="color: #6b7280;">${point.tehsil || 'N/A'}</span></div>
                                <div><strong style="color: #374151;">Compartment:</strong><br><span style="color: #6b7280;">${point.compartment_no || 'N/A'}</span></div>
                            </div>
                            
                            <div style="background: #f8fafc; padding: 8px; border-radius: 6px; margin-bottom: 10px;">
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px 12px; font-size: 12px;">
                                    <div><strong style="color: #374151;">Funding Source</strong><br><span style="color: #059669;">${point.scheme_name || 'N/A'}</span></div>
                                    <div><strong style="color: #374151;">Year:</strong><br><span style="color: #059669;">${point.year || 'N/A'}</span></div>
                                    <div style="grid-column: 1 / -1;"><strong style="color: #374151;">Type:</strong><br><span style="color: #6b7280;">${point.type || 'N/A'}</span></div>
                                </div>
                            </div>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px 12px; font-size: 12px; margin-bottom: 10px;">
                                <div><strong style="color: #374151;">Plants:</strong><br><span style="color: #dc2626;">${point.total_plants?.toLocaleString() || 'N/A'}</span></div>
                                <div><strong style="color: #374151;">Area:</strong><br><span style="color: #dc2626;">${point.planted_area_acre || 'N/A'} acres</span></div>
                            </div>
                            
                            <div style="font-size: 11px; color: #9ca3af; margin-bottom: 12px;">
                                <strong>Coordinates:</strong> ${point.latitude?.toFixed(6) || 'N/A'}, ${point.longitude?.toFixed(6) || 'N/A'}
                            </div>
                            
                            ${point.remarks && point.remarks.trim() !== '' && point.remarks.trim() !== ' ' ? 
                                `<div style="background: #fffbeb; border-left: 3px solid #f59e0b; padding: 6px 8px; margin-bottom: 12px; font-size: 11px;">
                                    <strong style="color: #92400e;">Remarks:</strong> 
                                    <span style="color: #78350f;">${point.remarks}</span>
                                </div>` : ''
                            }

                            ${point.video_link ? `
                                <div style="margin-top: 10px;">
                                    <a href="${point.video_link}" target="_blank" style="display: inline-block; background: #3b82f6; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none;">
                                        <i class="fas fa-video"></i> View Video
                                    </a>
                                </div>
                            ` : ''}
                            
                            <div style="background: #f3f4f6; border-radius: 6px; padding: 8px; text-align: center; min-height: 80px; display: flex; align-items: center; justify-content: center;">
                                ${point.image1 ? 
                                    `<img src="${point.image1}" alt="Plantation Image" style="max-width: 100%; max-height: 120px; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.2);" 
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                     <div style="display: none; color: #9ca3af; font-size: 11px;">
                                         <i class="fas fa-image" style="font-size: 16px; margin-bottom: 4px;"></i><br>
                                         Image failed to load
                                     </div>` : 
                                    `<div style="color: #9ca3af; font-size: 11px;">
                                         <i class="fas fa-image" style="font-size: 16px; margin-bottom: 4px;"></i><br>
                                         No image available
                                     </div>`
                                }
                            </div>
                        </div>
                    `;
                    
                    marker.bindPopup(popupContent);
                    marker.addTo(plantationMap);
                    plantationMarkers.push(marker);
                    validPointsCount++;
                } else {
                    console.warn('Point missing coordinates:', point);
                }
            });
            
            console.log('Added', validPointsCount, 'valid markers to map');
            
            // Only fit bounds if we have plantation markers to avoid overriding boundary zoom
            // The boundary fitting should take priority over data points
            console.log('Plantation points added, boundary zoom preserved');
        }
        

        function updatePlantationDropdownOptions(rawData) {
            // Get unique years from the data (sorted newest first)
            const years = [...new Set(rawData.map(item => item.year))]
                .filter(year => year !== null && year !== undefined)
                .sort((a, b) => b - a);

            // Update year dropdown
            const yearSelect = document.getElementById('plantationYearSel');
            const currentYear = yearSelect.value;
            yearSelect.innerHTML = '<option value="">All Years</option>';
            years.forEach(year => {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                yearSelect.appendChild(option);
            });

            // Restore selection if still available
            if (years.includes(parseInt(currentYear))) {
                yearSelect.value = currentYear;
            }

            // Get unique schemes from the data (sorted alphabetically)
            const schemes = [...new Set(rawData.map(item => item.scheme_name))]
                .filter(scheme => scheme !== null && scheme !== undefined)
                .sort();

            // Update scheme dropdown
            const schemeSelect = document.getElementById('plantationSchemeSel');
            const currentScheme = schemeSelect.value;
            schemeSelect.innerHTML = '<option value="">All Schemes</option>';
            schemes.forEach(scheme => {
                const option = document.createElement('option');
                option.value = scheme;
                option.textContent = scheme;
                schemeSelect.appendChild(option);
            });

            // Restore selection if still available
            if (schemes.includes(currentScheme)) {
                schemeSelect.value = currentScheme;
            }
        }

        function updatePlantationStatistics(statsSummary) {
            if (!statsSummary || statsSummary.length === 0) {
                document.getElementById('statsTableBody').innerHTML = '<tr><td colspan="5" class="text-center">No statistics available</td></tr>';
                return;
            }

            // Update table
            const tableBody = document.getElementById('statsTableBody');
            tableBody.innerHTML = '';

            statsSummary.forEach(stat => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${stat.year}</td>
                    <td>${stat.scheme_name}</td>
                    <td>${stat.total_plants.toLocaleString()}</td>
                    <td>${stat.total_planted_area_acre.toLocaleString()}</td>
                `;
                tableBody.appendChild(row);
            });

            // Update charts
            updatePlantationCharts(statsSummary);
        }

        function updatePlantationCharts(statsSummary) {
            // Prepare data for charts
            const yearData = {};
            const schemeData = {};

            statsSummary.forEach(stat => {
                // Year data
                if (!yearData[stat.year]) {
                    yearData[stat.year] = { plants: 0, area: 0 };
                }
                yearData[stat.year].plants += stat.total_plants;
                yearData[stat.year].area += stat.total_planted_area_acre;

                // Scheme data
                if (!schemeData[stat.scheme_name]) {
                    schemeData[stat.scheme_name] = { plants: 0, area: 0 };
                }
                schemeData[stat.scheme_name].plants += stat.total_plants;
                schemeData[stat.scheme_name].area += stat.total_planted_area_acre;
            });

            // Plants by Year chart
            Highcharts.chart('plantsChart', {
                chart: { type: 'column' },
                title: { text: 'Plants by Year' },
                xAxis: { categories: Object.keys(yearData) },
                yAxis: { title: { text: 'Number of Plants' } },
                series: [{
                    name: 'Plants',
                    data: Object.values(yearData).map(d => d.plants),
                    color: '#28a745'
                }],
                tooltip: {
                    formatter: function () {
                        return `<b>${this.x}</b><br/>Total Plants: ${this.y.toLocaleString()}`;
                    }
                }
            });

            // Area by Scheme chart
            Highcharts.chart('areaChart', {
                chart: { type: 'pie' },
                title: { text: 'Area by Scheme' },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y:.1f} acres'
                        }
                    }
                },
                series: [{
                    name: 'Area',
                    colorByPoint: true,
                    data: Object.keys(schemeData).map(scheme => ({
                        name: scheme,
                        y: schemeData[scheme].area,
                        color: getSchemeColor(scheme)
                    }))
                }],
                tooltip: {
                    formatter: function () {
                        return `<b>${this.point.name}</b><br/>Area: ${this.y.toLocaleString()} acres<br/>Plants: ${schemeData[this.point.name].plants.toLocaleString()}`;
                    }
                }
            });
        }

        // ================================
        // CHANGE ANALYSIS TAB FUNCTIONALITY
        // ================================
        
        function handleChangeZoneSelection(zone) {
            const circleDropdown = document.getElementById('changeCircleSel');
            const divisionDropdown = document.getElementById('changeDivisionSel');

            // Reset dependent dropdowns
            resetDropdown(circleDropdown, 'Select Circle');
            resetDropdown(divisionDropdown, 'Select Division');

            if (zone) {
                // Disable year checkboxes while loading
                setYearCheckboxesState(false, 'Loading...');
                
                // Enable circle dropdown and populate from API
                circleDropdown.disabled = false;
                loadCirclesData(zone, 'change');
                
                // Draw zone boundary on map
                drawBoundary(zone, 'zone', changeMap, changeLayers);
                
                // Load change analysis data for zone level
                loadChangeAnalysisForLevel({ zone: zone });
            } else {
                circleDropdown.disabled = true;
                divisionDropdown.disabled = true;
                clearMapLayers('zone', changeLayers, changeMap);
                clearChangeAnalysisData();
                setYearCheckboxesState(false, 'Select zone first');
            }
        }

        function handleChangeCircleSelection(circle) {
            const divisionDropdown = document.getElementById('changeDivisionSel');

            resetDropdown(divisionDropdown, 'Select Division');

            if (circle) {
                // Disable year checkboxes while loading
                setYearCheckboxesState(false, 'Loading...');
                
                divisionDropdown.disabled = false;
                loadDivisionsData(circle, 'change');
                drawBoundary(circle, 'circle', changeMap, changeLayers);
                
                // Load change analysis data for circle level
                const zone = document.getElementById('changeZoneSel').value;
                loadChangeAnalysisForLevel({ zone: zone, circle: circle });
            } else {
                divisionDropdown.disabled = true;
                clearMapLayers('circle', changeLayers, changeMap);
                
                // Reload zone level data
                const zone = document.getElementById('changeZoneSel').value;
                if (zone) {
                    setYearCheckboxesState(false, 'Loading...');
                    loadChangeAnalysisForLevel({ zone: zone });
                } else {
                    setYearCheckboxesState(false, 'Select zone first');
                }
            }
        }

        function handleChangeDivisionSelection(division) {
            if (division) {
                // Disable year checkboxes while loading
                setYearCheckboxesState(false, 'Loading...');
                
                drawBoundary(division, 'division', changeMap, changeLayers);
                
                // Load change analysis data for division level
                const zone = document.getElementById('changeZoneSel').value;
                const circle = document.getElementById('changeCircleSel').value;
                loadChangeAnalysisForLevel({ zone: zone, circle: circle, division: division });
            } else {
                clearMapLayers('division', changeLayers, changeMap);
                
                // Reload circle level data
                const zone = document.getElementById('changeZoneSel').value;
                const circle = document.getElementById('changeCircleSel').value;
                if (circle) {
                    setYearCheckboxesState(false, 'Loading...');
                    loadChangeAnalysisForLevel({ zone: zone, circle: circle });
                } else if (zone) {
                    setYearCheckboxesState(false, 'Loading...');
                    loadChangeAnalysisForLevel({ zone: zone });
                } else {
                    setYearCheckboxesState(false, 'Select zone first');
                }
            }
        }

        // New function to load change analysis data for any level
        function loadChangeAnalysisForLevel(filters) {
            const cacheKey = `${filters.zone || 'null'}_${filters.circle || 'null'}_${filters.division || 'null'}`;
            
            console.log('Loading change analysis for:', filters);
            
            if (cachedYearData[cacheKey] && cachedYearDataStat[cacheKey]) {
                console.log('Using cached data for:', cacheKey);
                // Use cached data and set global variables
                window.currentSpatialData = cachedYearData[cacheKey];
                window.currentStatsData = cachedYearDataStat[cacheKey];
                updateChangeAnalysisDisplay(cachedYearData[cacheKey], cachedYearDataStat[cacheKey]);
                // Enable checkboxes after data is ready
                setYearCheckboxesState(true);
            } else {
                // Load fresh data
                showLoader();
                Promise.all([
                    getChangeAnalysisData(filters),
                    loadChangeStatistics(filters)
                ]).then(([spatialData, statsResponse]) => {
                    console.log('Fresh data loaded:', { spatialData, statsResponse });
                    
                    let validSpatialData = null;
                    let validStatsData = null;
                    
                    if (spatialData && spatialData.status === 'success') {
                        cachedYearData[cacheKey] = spatialData;
                        validSpatialData = spatialData;
                        window.currentSpatialData = spatialData;
                        console.log('Spatial data set globally:', spatialData);
                    }
                    
                    if (statsResponse && statsResponse.status === "success") {
                        cachedYearDataStat[cacheKey] = statsResponse.data;
                        validStatsData = statsResponse.data;
                        window.currentStatsData = statsResponse.data;
                        console.log('Stats data set globally:', statsResponse.data);
                    }
                    
                    updateChangeAnalysisDisplay(validSpatialData, validStatsData);
                    
                    // Enable checkboxes after data is loaded
                    setYearCheckboxesState(true);
                    hideLoader();
                }).catch(error => {
                    console.error('Error loading change analysis data:', error);
                    setYearCheckboxesState(false, 'Error loading data');
                    hideLoader();
                });
            }
        }

        function updateChangeAnalysisDisplay(spatialData, statsData) {
            console.log('updateChangeAnalysisDisplay called:', { spatialData: !!spatialData, statsData: !!statsData });
            
            // Clear existing layers
            clearYearLayers();
            
            // Reset checkboxes
            document.querySelectorAll('.year-checkboxes input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            
            // Update chart with new data
            updateLULCChart(statsData);
            
            // Store current data for layer drawing - IMPORTANT: Set these properly
            if (spatialData && spatialData.status === 'success') {
                window.currentSpatialData = spatialData;
                console.log('✅ Spatial data stored globally');
            } else {
                window.currentSpatialData = null;
                console.log('❌ No valid spatial data to store');
            }
            
            if (statsData) {
                window.currentStatsData = statsData;
                console.log('✅ Stats data stored globally');
            } else {
                window.currentStatsData = null;
                console.log('❌ No stats data to store');
            }
        }

        function clearChangeAnalysisData() {
            clearYearLayers();
            updateLULCChart(null);
            window.currentSpatialData = null;
            window.currentStatsData = null;
            
            // Reset and disable checkboxes
            setYearCheckboxesState(false, 'Select zone first');
        }

        // Helper function to enable/disable year checkboxes with message
        function setYearCheckboxesState(enabled, message = '') {
            const checkboxes = document.querySelectorAll('.year-checkboxes input[type="checkbox"]');
            const labels = document.querySelectorAll('.year-checkboxes label');
            
            checkboxes.forEach(checkbox => {
                checkbox.disabled = !enabled;
                checkbox.checked = false; // Reset when disabled
            });
            
            labels.forEach(label => {
                if (enabled) {
                    label.style.opacity = '1';
                    label.style.cursor = 'pointer';
                    label.title = '';
                } else {
                    label.style.opacity = '0.5';
                    label.style.cursor = 'not-allowed';
                    label.title = message;
                }
            });
            
            // Simple loading message without extra styling
            if (!enabled && message) {
                const sidebarContent = document.getElementById('sidebarContent');
                let loadingMsg = document.getElementById('yearLoadingMsg');
                
                if (!loadingMsg) {
                    loadingMsg = document.createElement('div');
                    loadingMsg.id = 'yearLoadingMsg';
                    loadingMsg.style.cssText = 'font-size: 11px; color: #666; margin-top: 5px; text-align: center;';
                    sidebarContent.appendChild(loadingMsg);
                }
                loadingMsg.textContent = message;
            } else {
                // Remove loading message
                const loadingMsg = document.getElementById('yearLoadingMsg');
                if (loadingMsg) {
                    loadingMsg.remove();
                }
            }
        }

        function clearYearLayers() {
            // Clear all year layers
            Object.keys(changeLayers).forEach(key => {
                if (key.startsWith('year') && changeLayers[key]) {
                    changeMap.removeLayer(changeLayers[key]);
                    delete changeLayers[key];
                }
            });
        }

        // Updated draw year layers function
        function drawYearLayers(checked, year) {
            console.log('drawYearLayers called:', { checked, year });
            
            // Check if checkboxes are disabled (data still loading)
            const checkbox = document.querySelector(`input[value="${year}"]`);
            if (checkbox && checkbox.disabled) {
                console.log('Checkbox is disabled, data still loading');
                checkbox.checked = false;
                return;
            }
            
            console.log('currentSpatialData exists:', !!window.currentSpatialData);
            console.log('currentStatsData exists:', !!window.currentStatsData);
            
            if (!window.currentSpatialData) {
                console.error('No spatial data available');
                alert('Data is still loading, please wait...');
                document.querySelector(`input[value="${year}"]`).checked = false;
                return;
            }

            if (checked) {
                console.log('Creating year layers for:', year);
                createYearLayers(window.currentSpatialData, year);
                if (window.currentStatsData) {
                    updateLULCChart(window.currentStatsData);
                }
            } else {
                console.log('Removing year layers for:', year);
                removeYearLayers(year);
                if (window.currentStatsData) {
                    updateLULCChart(window.currentStatsData);
                }
            }
        }

        // Updated API functions to accept filters object
        async function getChangeAnalysisData(filters) {
            try {
                showLoader();
                const response = await fetch('statsAPIs/getLULCSpatial.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(filters)
                });
                const data = await response.json();
                hideLoader();
                return data;
            } catch (error) {
                console.error('Error:', error);
                hideLoader();
                return null;
            }
        }

        async function loadChangeStatistics(filters) {
            try {
                showLoader();
                const response = await fetch('statsAPIs/getLCLUStat.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(filters)
                });
                const data = await response.json();
                hideLoader();
                return data;
            } catch (error) {
                console.error('Error:', error);
                hideLoader();
                return null;
            }
        }

           // Update the LULC chart to show acres
    function updateLULCChart(lulcData) {
        if (!lulcData) {
            // Clear chart if no data
            lulcChart.data.labels = [];
            lulcChart.data.datasets = [];
            lulcChart.update();
            document.getElementById('changeStatsTable').style.display = 'none';
            return;
        }

        // Get selected years from checkboxes
        const selectedYears = [];
        document.querySelectorAll('.year-checkboxes input[type="checkbox"]:checked').forEach(checkbox => {
            selectedYears.push(checkbox.value);
        });

        if (selectedYears.length === 0) {
            lulcChart.data.labels = [];
            lulcChart.data.datasets = [];
            lulcChart.update();
            document.getElementById('changeStatsTable').style.display = 'none';
            return;
        }

        // Land cover types
        const landCoverTypes = ['Tree Cover', 'Agriland/Grass', 'Water', 'Barren Land', 'Builtup'];
        const labelToKey = {
            'Tree Cover': 'tree_cover',
            'Agriland/Grass': 'agriland_grass',
            'Water': 'water',
            'Barren Land': 'barren_land',
            'Builtup': 'builtup'
        };

        // Conversion factor from SQ.KM to acres
        const SQ_KM_TO_ACRES = 247.105;

        // Colors for different years
        const yearColors = {
            '2023': 'rgba(37, 101, 230, 0.8)',
            '2025': 'rgba(199, 32, 68, 0.8)',
            '2024': 'rgba(75, 192, 192, 0.8)',
            '2022': 'rgba(153, 102, 255, 0.8)',
            '2021': 'rgba(255, 159, 64, 0.8)'
        };

        // Update chart
        lulcChart.data.labels = landCoverTypes;
        lulcChart.data.datasets = [];

        selectedYears.forEach(year => {
            if (lulcData[year]) {
                const dataset = {
                    label: year,
                    data: landCoverTypes.map(type => {
                        const key = labelToKey[type];
                        return (lulcData[year][key] || 0) * SQ_KM_TO_ACRES;
                    }),
                    backgroundColor: yearColors[year] || 'rgba(128, 128, 128, 0.8)',
                    borderColor: yearColors[year] || 'rgba(128, 128, 128, 1)',
                    borderWidth: 1
                };
                lulcChart.data.datasets.push(dataset);
            }
        });

        lulcChart.update();

        // Update stats table
        updateChangeStatsTable(lulcData, selectedYears, landCoverTypes, labelToKey);
    }

    function updateChangeStatsTable(lulcData, selectedYears, landCoverTypes, labelToKey) {
    const statsTable = document.getElementById('changeStatsTable');
    const statsTableBody = document.getElementById('changeStatsTableBody');
    const summaryCards = document.getElementById('changeSummaryCards');
    const totalForestCover = document.getElementById('changeTotalForestCover');
    const totalArea = document.getElementById('changeTotalArea');

    if (selectedYears.length === 0) {
        if (statsTable) statsTable.style.display = 'none';
        if (summaryCards) summaryCards.style.display = 'none';
        return;
    }

    // Conversion factor from SQ.KM to acres
    const SQ_KM_TO_ACRES = 247.105;

    // Clear table body
    if (statsTableBody) {
        statsTableBody.innerHTML = '';

        // Create header row
        const headerRow = document.createElement('tr');
        
        // Add land cover type header
        const typeHeader = document.createElement('th');
        typeHeader.textContent = 'Land Cover Type';
        typeHeader.style.background = '#16a34a';
        typeHeader.style.color = 'white';
        typeHeader.style.fontWeight = '600';
        headerRow.appendChild(typeHeader);

        // Add year columns headers
        selectedYears.forEach(year => {
            const yearHeader = document.createElement('th');
            yearHeader.textContent = `${year} (acres)`;
            yearHeader.style.background = '#16a34a';
            yearHeader.style.color = 'white';
            yearHeader.style.fontWeight = '600';
            headerRow.appendChild(yearHeader);
        });

        statsTableBody.appendChild(headerRow);

        let totalForest = {};
        let grandTotal = {};
        let overallForestTotal = 0;
        let overallGrandTotal = 0;

        // Initialize totals for each year
        selectedYears.forEach(year => {
            totalForest[year] = 0;
            grandTotal[year] = 0;
        });

        // Add rows for each land cover type
        landCoverTypes.forEach(type => {
            const row = document.createElement('tr');
            
            // Add land cover type cell
            const typeCell = document.createElement('td');
            typeCell.textContent = type;
            typeCell.style.fontWeight = 'bold';
            row.appendChild(typeCell);

            // Add data cells for each year
            selectedYears.forEach(year => {
                const dataCell = document.createElement('td');
                const key = labelToKey[type];
                const value = lulcData[year] ? (lulcData[year][key] || 0) * SQ_KM_TO_ACRES : 0;
                dataCell.textContent = value.toFixed(2);

                // Add to yearly totals
                if (type === 'Tree Cover') {
                    totalForest[year] += value;
                    overallForestTotal += value;
                }
                grandTotal[year] += value;
                overallGrandTotal += value;

                row.appendChild(dataCell);
            });

            statsTableBody.appendChild(row);
        });

        // Add totals row
        const totalsRow = document.createElement('tr');
        totalsRow.style.fontWeight = 'bold';
        
        // Add label cell
        const totalsLabelCell = document.createElement('td');
        totalsLabelCell.textContent = 'Total';
        totalsRow.appendChild(totalsLabelCell);

        // Add total cells for each year
        selectedYears.forEach(year => {
            const totalCell = document.createElement('td');
            totalCell.textContent = grandTotal[year].toFixed(2);
            totalsRow.appendChild(totalCell);
        });

        statsTableBody.appendChild(totalsRow);

        // Update summary cards with OVERALL totals across all years
        if (totalForestCover && totalArea) {
            totalForestCover.textContent = `${overallForestTotal.toFixed(2)} acres`;
            totalArea.textContent = `${overallGrandTotal.toFixed(2)} acres`;
        }
    }

    if (statsTable) statsTable.style.display = 'block';
    if (summaryCards) summaryCards.style.display = 'flex';
}

        // ================================
        // SHARED FUNCTIONS
        // ================================
        
        function loadCirclesData(zone, type) {
            return fetch(`${API_BASE_URL}fetch_circles.php?forest_zone=${encodeURIComponent(zone)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const circleDropdownId = type === 'plantation' ? 'plantationCircleSel' : 'changeCircleSel';
                        const circleDropdown = document.getElementById(circleDropdownId);
                        resetDropdown(circleDropdown, 'Select Circle');
                        
                        data.data.forEach(circle => {
                            const option = document.createElement('option');
                            option.value = circle;
                            option.textContent = circle;
                            circleDropdown.appendChild(option);
                        });
                        
                        circleDropdown.disabled = false;
                    }
                });
        }

        function loadDivisionsData(circle, type) {
            return fetch(`${API_BASE_URL}fetch_divisions.php?forest_circle=${encodeURIComponent(circle)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const divisionDropdownId = type === 'plantation' ? 'plantationDivisionSel' : 'changeDivisionSel';
                        const divisionDropdown = document.getElementById(divisionDropdownId);
                        resetDropdown(divisionDropdown, 'Select Division');
                        
                        data.data.forEach(division => {
                            const option = document.createElement('option');
                            option.value = division;
                            option.textContent = division;
                            divisionDropdown.appendChild(option);
                        });
                        
                        divisionDropdown.disabled = false;
                    }
                });
        }

        function loadForestsData(division, type) {
            return fetch(`${API_BASE_URL}fetch_forests.php?forest_division=${encodeURIComponent(division)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const forestDropdown = document.getElementById('plantationForestSel');
                        resetDropdown(forestDropdown, 'Select Forest');
                        
                        data.data.forEach(forest => {
                            const option = document.createElement('option');
                            option.value = forest.unique_id;
                            option.textContent = forest.forest_name;
                            forestDropdown.appendChild(option);
                        });
                        
                        forestDropdown.disabled = false;
                    }
                });
        }

        function drawBoundary(name, type, targetMap, targetLayers) {
            showLoader();
            clearMapLayers(type, targetLayers, targetMap);

            let apiEndpoint = '';
            let requestBody = {};

            switch(type) {
                case 'zone':
                    apiEndpoint = 'get_forest_zone.php';
                    requestBody = { forest_zone: name };
                    break;
                case 'circle':
                    apiEndpoint = 'get_circle.php';
                    requestBody = { forest_circle: name };
                    break;
                case 'division':
                    apiEndpoint = 'get_division.php';
                    requestBody = { forest_division: name };
                    break;
            }

            const requestOptions = type === 'zone' ? {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(requestBody)
            } : {};

            const url = type === 'zone' ? `${API_BASE_URL}${apiEndpoint}` : `${API_BASE_URL}${apiEndpoint}?${Object.keys(requestBody)[0]}=${encodeURIComponent(Object.values(requestBody)[0])}`;

            fetch(url, requestOptions)
                .then(response => response.json())
                .then(data => {
                    showLoader();
                    if (data.status === 'success' && data.data.length > 0) {
                        const geoJson = {
                            type: 'Feature',
                            geometry: data.data[0].geometry,
                            properties: {
                                name: data.data[0][Object.keys(requestBody)[0]]
                            }
                        };

                        const colors = {
                            zone: { color: '#FFA500', weight: 3, maxZoom: 7 },
                            circle: { color: '#0000FF', weight: 2, maxZoom: 10 },
                            division: { color: '#800080', weight: 2, maxZoom: 12}
                        };

                        const style = colors[type];
                        
                        targetLayers[type] = L.geoJSON(geoJson, {
                            style: {
                                color: style.color,
                                weight: style.weight,
                                opacity: 1,
                                fillOpacity: 0.2
                            }
                        }).addTo(targetMap);

                        // Always fit bounds to the boundary layer
                        const bounds = targetLayers[type].getBounds();
                        targetMap.fitBounds(bounds, {
                            padding: [20, 20],
                            maxZoom: style.maxZoom
                        });
                        hideLoader();

                        console.log(`Map fitted to ${type} boundary`);
                    } else {
                        console.error(`Error loading ${type} boundary:`, data.message);
                    }
                    hideLoader();
                })
                .catch(error => {
                    console.error('Error:', error);
                    hideLoader();
                });
        }

        function drawForestBoundary(forestId, targetMap, targetLayers) {
            showLoader();
            clearMapLayers('forest', targetLayers, targetMap);

            fetch(`${API_BASE_URL}get_forest.php?unique_id=${encodeURIComponent(forestId)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success' && data.data.features.length > 0) {
                        targetLayers.forest = L.geoJSON(data.data, {
                            style: {
                                color: '#008000',
                                weight: 2,
                                opacity: 1,
                                fillOpacity: 0.2
                            }
                        }).addTo(targetMap);

                        // Always fit bounds to the forest boundary
                        const bounds = targetLayers.forest.getBounds();
                        targetMap.fitBounds(bounds, {
                            padding: [20, 20],
                            maxZoom: 18
                        });
                        
                        console.log('Map fitted to forest boundary');
                    } else {
                        console.error('Error loading forest boundary:', data.message);
                    }
                    hideLoader();
                })
                .catch(error => {
                    console.error('Error:', error);
                    hideLoader();
                });
        }

    function drawForestBoundaries(forestFeatures) {
        // Clear existing forest boundaries
        // if (forestBoundariesLayer) {
        //     plantationMap.removeLayer(forestBoundariesLayer);
        //     forestBoundariesLayer = null;
        // }

        // Style for forest boundaries
        const style = {
            color: '#006400', // Dark green
            weight: 2,
            opacity: 0.7,
            fillColor: '#90EE90', // Light green
            fillOpacity: 0.2
        };
        
        // Create hover style
        const hoverStyle = {
            weight: 3,
            opacity: 1,
            fillOpacity: 0.3
        };
        
        // Add forest boundaries to map
        forestBoundariesLayer = L.geoJSON({
            type: 'FeatureCollection',
            features: forestFeatures
        }, {
            style: style,
            onEachFeature: (feature, layer) => {
                // Add hover effects
                layer.on({
                    mouseover: function() {
                        this.setStyle(hoverStyle);
                    },
                    mouseout: function() {
                        this.setStyle(style);
                    }
                });
                
                // Add popup with forest information
                const popupContent = `
                    <div class="forest-popup">
                        <h5>${feature.properties.name || 'Unnamed Forest'}</h5>
                        ${feature.properties.area ? `<p><strong>Area:</strong> ${feature.properties.area} acres</p>` : ''}
                        ${feature.properties.tehsil ? `<p><strong>Tehsil:</strong> ${feature.properties.tehsil}</p>` : ''}
                    </div>
                `;
                layer.bindPopup(popupContent);
            }
        }).addTo(plantationMap);
        
        // Fit bounds to show both forests and points if available
        if (currentPlantationData?.raw_data?.length > 0) {
            const pointGroup = new L.featureGroup(plantationMarkers);
            const allFeatures = new L.featureGroup([forestBoundariesLayer, pointGroup]);
            plantationMap.fitBounds(allFeatures.getBounds(), { padding: [50, 50] });
        } else if (forestFeatures.length > 0) {
            plantationMap.fitBounds(forestBoundariesLayer.getBounds(), { padding: [50, 50] });
        }
}   
        function clearMapLayers(layerType, targetLayers, targetMap) {
            if (layerType && targetLayers[layerType]) {
                targetMap.removeLayer(targetLayers[layerType]);
                targetLayers[layerType] = null;
            } else if (!layerType) {
                Object.keys(targetLayers).forEach(key => {
                    if (targetLayers[key]) {
                        targetMap.removeLayer(targetLayers[key]);
                        targetLayers[key] = null;
                    }
                });
            }
        }

        function clearPlantationPoints() {
            // Clear markers
            plantationMarkers.forEach(marker => {
                plantationMap.removeLayer(marker);
            });
            plantationMarkers = [];
            
            // Clear forest boundaries
            if (forestBoundariesLayer) {
                plantationMap.removeLayer(forestBoundariesLayer);
                forestBoundariesLayer = null;
            }
            
            hideNoDataMessage();
        }

        // ================================
        // UTILITY FUNCTIONS
        // ================================
        
        function resetDropdown(dropdown, placeholder) {
            dropdown.innerHTML = `<option value="" selected>${placeholder}</option>`;
        }

        function showLoader() {
            document.getElementById('loader').classList.add('show');
        }

        function hideLoader() {
            document.getElementById('loader').classList.remove('show');
        }

        // Helper function to create custom icon for plantation markers
        function createCustomIcon(color) {
            return L.divIcon({
                html: `<i class="fas fa-tree" style="color: ${color}; font-size: 18px; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);"></i>`,
                className: 'custom-plantation-icon',
                iconSize: [20, 20],
                iconAnchor: [10, 10]
            });
        }

        // Function to get or create a color for a scheme - only yellow, blue, green shades
      // Improved color assignment with distinct palettes
        function getSchemeColor(schemeName) {
            if (!schemeName) return '#CCCCCC';
            
            // Return existing color if already assigned
            if (schemeColors[schemeName]) {
                return schemeColors[schemeName];
            }
            
            // Organized color palettes
            const colorPalettes = {
                green: ['#2E8B57', '#3CB371', '#20B2AA', '#32CD32', '#228B22', '#008000'],
                blue: ['#1E90FF', '#4169E1', '#4682B4', '#5F9EA0', '#6495ED', '#00BFFF'],
                purple: ['#9370DB', '#8A2BE2', '#9932CC', '#9400D3', '#8B008B', '#800080'],
                orange: ['#FF8C00', '#FFA500', '#FF6347', '#FF7F50', '#FF4500', '#FFD700'],
                red: ['#DC143C', '#FF0000', '#B22222', '#CD5C5C', '#FF4500', '#FF6347']
            };
            
            // Get all currently assigned colors
            const usedColors = Object.values(schemeColors);
            
            // Try to assign from each palette in turn
            for (const [paletteName, paletteColors] of Object.entries(colorPalettes)) {
                for (const color of paletteColors) {
                    // Skip if color is already used
                    if (!usedColors.includes(color)) {
                        schemeColors[schemeName] = color;
                        return color;
                    }
                }
            }
            
            // Fallback to random color if all palette colors are used
            const fallbackColors = [
                '#FF69B4', '#BA55D3', '#00FA9A', '#48D1CC', '#FFD700', 
                '#FF8C00', '#FF6347', '#7CFC00', '#ADFF2F', '#DA70D6'
            ];
            
            // Find first unused fallback color
            for (const color of fallbackColors) {
                if (!usedColors.includes(color)) {
                    schemeColors[schemeName] = color;
                    return color;
                }
            }
            
            // Ultimate fallback - generate random color
            const randomColor = '#' + Math.floor(Math.random()*16777215).toString(16);
            schemeColors[schemeName] = randomColor;
            return randomColor;
        }

        // Function to update the map legend for Funding Sources
        function updateMapLegend(schemes) {
            // Remove existing legend if it exists
            const existingLegend = document.querySelector('.map-legend');
            if (existingLegend) existingLegend.remove();

            // Create legend container
            const legend = L.control({ position: 'bottomright' });

            legend.onAdd = function (map) {
                const div = L.DomUtil.create('div', 'map-legend');
                div.innerHTML = '<h4><i class="fas fa-map-legend"></i> Funding Sources</h4>';
                
                // Sort schemes alphabetically for consistent ordering
                schemes.sort().forEach(scheme => {
                    const color = getSchemeColor(scheme);
                    div.innerHTML += `
                        <div class="legend-item">
                            <i class="fas fa-tree" style="color: ${color}"></i>
                            <span>${scheme}</span>
                        </div>
                    `;
                });

                return div;
            };

            legend.addTo(plantationMap);
        }

        // Function to show/hide no data message
        function showNoDataMessage() {
            if (!document.getElementById('noDataMessage')) {
                const noDataDiv = L.DomUtil.create('div', 'no-data-message');
                noDataDiv.id = 'noDataMessage';
                noDataDiv.innerHTML = '<i class="fas fa-info-circle"></i> No plantation data available';
                noDataDiv.style.position = 'absolute';
                noDataDiv.style.zIndex = '1000';
                noDataDiv.style.padding = '10px';
                noDataDiv.style.background = 'rgba(255,255,255,0.8)';
                noDataDiv.style.borderRadius = '5px';
                noDataDiv.style.top = '50%';
                noDataDiv.style.left = '50%';
                noDataDiv.style.transform = 'translate(-50%, -50%)';

                plantationMap.getContainer().appendChild(noDataDiv);
            }
        }

        function hideNoDataMessage() {
            const noDataMsg = document.getElementById('noDataMessage');
            if (noDataMsg) noDataMsg.remove();
        }

        // Toggle sidebar for change analysis
        function toggleSidebar() {
            const sidebar = document.getElementById('spatialSidebar');
            const icon = document.getElementById('chevronIcon');

            sidebar.classList.toggle('collapsed');

            if (sidebar.classList.contains('collapsed')) {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        }
        // Create year layers on map
        function createYearLayers(yearData, year) {
            const filteredData = yearData.data.filter(item => item.year === year.toString());

            filteredData.forEach(item => {
                const safeClass = item.class.replace(/\s+/g, "_");
                const layerKey = `year${year}_${safeClass}`;

                if (changeLayers[layerKey]) return;

                const geoJsonFeature = {
                    type: "Feature",
                    geometry: JSON.parse(item.geom),
                    properties: {
                        class: item.class,
                        division: item.forest_division
                    }
                };

                const color = classColors[item.class] || '#000000';

                const layer = L.geoJSON(geoJsonFeature, {
                    style: {
                        color: color,
                        weight: 2,
                        fillOpacity: 0.7
                    }
                }).addTo(changeMap);

                changeLayers[layerKey] = layer;
            });
        }

        // Remove year layers from map
        function removeYearLayers(year) {
            const keysToRemove = Object.keys(changeLayers).filter(key => key.startsWith(`year${year}_`));

            keysToRemove.forEach(key => {
                if (changeLayers[key]) {
                    changeMap.removeLayer(changeLayers[key]);
                    delete changeLayers[key];
                }
            });
        }
    </script>
</body>

</html>