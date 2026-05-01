<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Clin tun - Full Stack Developer & IT Support</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <style>
            * {
                margin: 0;
                padding: 0;
            }
            
            :root {
                --primary: #667eea;
                --secondary: #764ba2;
                --accent: #f093fb;
                --dark: #1a1a2e;
                --light: #f8f9fa;
            }
            
            body {
                font-family: 'Poppins', 'Segoe UI', sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
                min-height: 100vh;
                overflow-x: hidden;
            }
            
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
            
            /* Navigation */
            .navbar {
                background: rgba(26, 26, 46, 0.95) !important;
                backdrop-filter: blur(20px);
                box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                padding: 1rem 0;
            }
            
            .navbar-brand {
                font-weight: 800;
                font-size: 1.8rem;
                background: linear-gradient(135deg, #667eea 0%, #f093fb 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                letter-spacing: -1px;
            }
            
            .nav-link {
                color: white !important;
                font-weight: 600;
                transition: all 0.3s ease;
                position: relative;
                margin: 0 10px;
            }
            
            .nav-link::after {
                content: '';
                position: absolute;
                width: 0;
                height: 2px;
                background: linear-gradient(135deg, #667eea 0%, #f093fb 100%);
                bottom: -5px;
                left: 0;
                transition: width 0.3s ease;
            }
            
            .nav-link:hover::after {
                width: 100%;
            }
            
            /* Database Status Indicator */
            .db-status-indicator {
                display: inline-block;
                width: 12px;
                height: 12px;
                border-radius: 50%;
                margin-left: 12px;
                vertical-align: middle;
                animation: pulse 2s infinite;
            }
            
            .db-status-indicator.connected {
                background-color: #10b981;
                box-shadow: 0 0 8px rgba(16, 185, 129, 0.6);
            }
            
            .db-status-indicator.disconnected {
                background-color: #ef4444;
                box-shadow: 0 0 8px rgba(239, 68, 68, 0.6);
            }
            
            @keyframes pulse {
                0%, 100% {
                    opacity: 1;
                }
                50% {
                    opacity: 0.7;
                }
            }
            .hero-section {
                background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(240, 147, 251, 0.1) 100%);
                backdrop-filter: blur(10px);
                padding: 100px 0;
                text-align: center;
                color: white;
                position: relative;
                overflow: hidden;
            }
            
            .hero-section::before {
                content: '';
                position: absolute;
                top: -50%;
                right: -10%;
                width: 500px;
                height: 500px;
                background: radial-gradient(circle, rgba(240, 147, 251, 0.1) 0%, transparent 70%);
                border-radius: 50%;
            }
            
            .hero-section::after {
                content: '';
                position: absolute;
                bottom: -50%;
                left: -10%;
                width: 500px;
                height: 500px;
                background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
                border-radius: 50%;
            }
            
            .hero-content {
                position: relative;
                z-index: 1;
            }
            
            .hero-title {
                font-size: 4rem;
                font-weight: 800;
                margin-bottom: 1rem;
                text-shadow: 0 4px 8px rgba(0,0,0,0.2);
                animation: fadeInDown 1s ease-out;
                letter-spacing: -2px;
            }
            
            .hero-subtitle {
                font-size: 1.7rem;
                margin-bottom: 1.5rem;
                opacity: 1;
                font-weight: 600;
                animation: fadeInUp 1s ease-out 0.2s both;
                color: #000000;
            }
            
            .hero-description {
                font-size: 1.1rem;
                margin-bottom: 2.5rem;
                opacity: 1;
                animation: fadeInUp 1s ease-out 0.4s both;
                color: #000000;
            }
            
            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translateY(-30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            /* Section Title */
            .section-title {
                font-size: 3rem;
                font-weight: 800;
                margin-bottom: 1rem;
                text-align: center;
                color: #1a1a2e;
                position: relative;
                letter-spacing: -1px;
            }
            
            .section-title::after {
                content: '';
                display: block;
                width: 100px;
                height: 4px;
                background: linear-gradient(135deg, #667eea 0%, #f093fb 100%);
                margin: 1rem auto;
                border-radius: 2px;
            }
            
            .section-subtitle {
                text-align: center;
                color: #666;
                margin-bottom: 3rem;
                font-size: 1.1rem;
            }
            
            /* Tech Cards */
            .tech-card {
                background: white;
                border-radius: 20px;
                padding: 40px 30px;
                text-align: center;
                box-shadow: 0 10px 40px rgba(0,0,0,0.1);
                transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
                height: 100%;
                position: relative;
                overflow: hidden;
                border: 1px solid rgba(255,255,255,0.5);
            }
            
            .tech-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(240, 147, 251, 0.1) 100%);
                transition: left 0.4s ease;
                z-index: 0;
            }
            
            .tech-card:hover::before {
                left: 0;
            }
            
            .tech-card > * {
                position: relative;
                z-index: 1;
            }
            
            .tech-card:hover {
                transform: translateY(-15px);
                box-shadow: 0 25px 60px rgba(102, 126, 234, 0.4);
            }
            
            .tech-card i {
                font-size: 3.5rem;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                margin-bottom: 1.5rem;
                display: inline-block;
                transition: transform 0.3s ease;
            }
            
            .tech-card:hover i {
                transform: scale(1.2) rotate(5deg);
            }
            
            .tech-card h5 {
                color: #1a1a2e;
                font-weight: 700;
                margin-bottom: 1rem;
                font-size: 1.3rem;
            }
            
            .tech-card p {
                color: #666;
                font-size: 0.95rem;
                line-height: 1.6;
            }
            
            /* Service Cards */
            .service-card {
                background: white;
                border-radius: 20px;
                padding: 40px 30px;
                box-shadow: 0 10px 40px rgba(0,0,0,0.08);
                transition: all 0.4s ease;
                border: none;
                position: relative;
                overflow: hidden;
            }
            
            .service-card::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                width: 5px;
                height: 100%;
                background: linear-gradient(180deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
                transition: width 0.4s ease;
            }
            
            .service-card:hover::before {
                width: 100%;
                opacity: 0.1;
            }
            
            .service-card:hover {
                transform: translateX(10px);
                box-shadow: 0 20px 50px rgba(102, 126, 234, 0.3);
            }
            
            .service-card h5 {
                color: #667eea;
                font-weight: 700;
                font-size: 1.3rem;
                margin-bottom: 1rem;
                position: relative;
                z-index: 1;
            }
            
            .service-card p {
                color: #666;
                margin-bottom: 1.5rem;
                font-size: 0.95rem;
                line-height: 1.7;
                position: relative;
                z-index: 1;
            }
            
            .service-card ul {
                text-align: left;
                color: #666;
                position: relative;
                z-index: 1;
            }
            
            .service-card li {
                margin-bottom: 0.7rem;
                padding-left: 1.5rem;
                position: relative;
            }
            
            .service-card li::before {
                content: '✓';
                position: absolute;
                left: 0;
                color: #667eea;
                font-weight: bold;
            }
            
            /* Skill Badges */
            .skill-badge {
                display: inline-block;
                background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(240, 147, 251, 0.15) 100%);
                backdrop-filter: blur(10px);
                padding: 12px 24px;
                border-radius: 30px;
                margin: 8px;
                color: #1a1a2e;
                border: 1.5px solid rgba(102, 126, 234, 0.3);
                transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
                font-weight: 600;
                cursor: pointer;
            }
            
            .skill-badge:hover {
                background: linear-gradient(135deg, rgba(102, 126, 234, 0.25) 0%, rgba(240, 147, 251, 0.25) 100%);
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(102, 126, 234, 0.2);
                border-color: rgba(102, 126, 234, 0.5);
            }
            
            .skill-badge i {
                margin-right: 8px;
            }
            
            /* Tech Grid */
            .tech-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
                gap: 20px;
                margin-top: 2.5rem;
            }
            
            .tech-item {
                background: linear-gradient(135deg, rgba(102, 126, 234, 0.08) 0%, rgba(240, 147, 251, 0.08) 100%);
                padding: 20px;
                border-radius: 15px;
                text-align: center;
                border: 1.5px solid rgba(102, 126, 234, 0.2);
                transition: all 0.3s ease;
                cursor: pointer;
            }
            
            .tech-item:hover {
                background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(240, 147, 251, 0.15) 100%);
                transform: translateY(-5px);
                border-color: rgba(102, 126, 234, 0.4);
            }
            
            .tech-item i {
                font-size: 2.2rem;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                margin-bottom: 10px;
                display: inline-block;
                transition: transform 0.3s ease;
            }
            
            .tech-item:hover i {
                transform: scale(1.15);
            }
            
            .tech-item p {
                font-size: 0.9rem;
                font-weight: 600;
                color: #1a1a2e;
            }
            
            /* Buttons */
            .btn-primary-custom {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border: none;
                padding: 14px 35px;
                font-weight: 700;
                transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
                border-radius: 10px;
                font-size: 1rem;
                position: relative;
                overflow: hidden;
            }
            
            .btn-primary-custom::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, #764ba2 0%, #f093fb 100%);
                transition: left 0.3s ease;
                z-index: -1;
            }
            
            .btn-primary-custom:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 35px rgba(102, 126, 234, 0.5);
                color: white;
            }
            
            .btn-outline-primary {
                color: #667eea;
                border: 2px solid #667eea;
                font-weight: 700;
                transition: all 0.3s ease;
                border-radius: 10px;
            }
            
            .btn-outline-primary:hover {
                background: #667eea;
                transform: translateY(-3px);
                box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
            }
            
            /* Sections */
            section {
                padding: 80px 0;
                position: relative;
            }
            
            section:nth-child(even) {
                background: #f8f9fa;
            }
            
            /* About Section */
            .about-text {
                font-size: 1.15rem;
                line-height: 1.8;
                color: #666;
                text-align: center;
                margin: 2rem auto;
            }
            
            /* Footer */
            .footer {
                background: linear-gradient(135deg, #1a1a2e 0%, #2d2d4f 100%);
                color: white;
                padding: 40px 0 20px;
                text-align: center;
                border-top: 1px solid rgba(255,255,255,0.1);
            }
            
            .footer p {
                margin-bottom: 0.5rem;
            }
            
            /* Responsive */
            @media (max-width: 768px) {
                .hero-title {
                    font-size: 2.5rem;
                }
                
                .hero-subtitle {
                    font-size: 1.3rem;
                }
                
                .section-title {
                    font-size: 2rem;
                }
                
                .tech-card, .service-card {
                    padding: 30px 20px;
                }
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
            <div class="container">
                <a class="navbar-brand" href="#"><i class="fas fa-code"></i> Clin tun
                    <span class="db-status-indicator {{ $dbConnected ? 'connected' : 'disconnected' }}" title="{{ $dbConnected ? 'Database Connected' : 'Database Disconnected' }}"></span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#skills">ทักษะ</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">บริการ</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">ติดต่อ</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h1 class="hero-title">Clin tun</h1>
                    <p class="hero-subtitle">นักพัฒนาแบบเต็มสเตก และ ผู้ให้บริการด้าน IT</p>
                    <p class="hero-description">
                        เปลี่ยนแนวคิดให้เป็นโซลูชันเว็บที่มีประสิทธิภาพด้วยเทคโนโลยีสมัยใหม่
                    </p>
                    <a href="#contact" class="btn btn-light btn-lg btn-primary-custom" style="color: white; margin-right: 1rem;">
                        <i class="fas fa-arrow-right"></i> เริ่มต้น
                    </a>
                    <a href="#services" class="btn btn-lg btn-outline-primary">
                        <i class="fas fa-briefcase"></i> บริการ
                    </a>
                </div>
            </div>
        </section>

        <!-- Skills Section -->
        <section id="skills" style="background: white;">
            <div class="container">
                <h2 class="section-title">ทักษะและเทคโนโลยี</h2>
                <p class="section-subtitle">เชี่ยวชาญเทคโนโลยีสมัยใหม่สำหรับการพัฒนาเว็บ</p>
                
                <div class="row">
                    <!-- Backend -->
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="tech-card">
                            <i class="fas fa-server"></i>
                            <h5>พัฒนา Backend</h5>
                            <p>สร้างแอปพลิเคชันฝั่งเซิร์ฟเวอร์ที่แข็งแรงด้วยเทคโนโลยีระดับเอนเตอร์ไพรส์</p>
                            <div class="tech-grid">
                                <div class="tech-item">
                                    <i class="fab fa-php"></i>
                                    <p class="small">PHP</p>
                                </div>
                                <div class="tech-item">
                                    <i class="fas fa-layer-group"></i>
                                    <p class="small">Laravel</p>
                                </div>
                                <div class="tech-item">
                                    <i class="fab fa-node-js"></i>
                                    <p class="small">Node.js</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Frontend -->
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="tech-card">
                            <i class="fas fa-laptop-code"></i>
                            <h5>พัฒนา Frontend</h5>
                            <p>สร้างส่วนติดต่อผู้ใช้ที่สวยงามและตอบสนองได้ดีด้วย Framework สมัยใหม่</p>
                            <div class="tech-grid">
                                <div class="tech-item">
                                    <i class="fab fa-react"></i>
                                    <p class="small">React</p>
                                </div>
                                <div class="tech-item">
                                    <i class="fas fa-zap"></i>
                                    <p class="small">Next.js</p>
                                </div>
                                <div class="tech-item">
                                    <i class="fab fa-js-square"></i>
                                    <p class="small">JavaScript</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Databases -->
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="tech-card">
                            <i class="fas fa-database"></i>
                            <h5>ออกแบบฐานข้อมูล</h5>
                            <p>ออกแบบโซลูชันการจัดการข้อมูลที่ปรับขนาดได้และมีประสิทธิภาพสูง</p>
                            <div class="tech-grid">
                                <div class="tech-item">
                                    <i class="fas fa-table"></i>
                                    <p class="small">MySQL</p>
                                </div>
                                <div class="tech-item">
                                    <i class="fas fa-cube"></i>
                                    <p class="small">NoSQL</p>
                                </div>
                                <div class="tech-item">
                                    <i class="fas fa-link"></i>
                                    <p class="small">Prisma</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Development -->
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="tech-card">
                            <i class="fas fa-mobile-alt"></i>
                            <h5>พัฒนา Mobile</h5>
                            <p>สร้างแอปพลิเคชัน Mobile ที่ทำงานบนอุปกรณ์ iOS และ Android</p>
                            <div class="tech-grid">
                                <div class="tech-item">
                                    <i class="fab fa-flutter"></i>
                                    <p class="small">Flutter</p>
                                </div>
                                <div class="tech-item">
                                    <i class="fab fa-apple"></i>
                                    <p class="small">iOS</p>
                                </div>
                                <div class="tech-item">
                                    <i class="fab fa-android"></i>
                                    <p class="small">Android</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Tools -->
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <h4 style="text-align: center; color: #1a1a2e; margin-bottom: 2.5rem; font-weight: 700; font-size: 1.5rem;">เครื่องมือและเทคโนโลยี</h4>
                        <div style="text-align: center;">
                            <span class="skill-badge">
                                <i class="fab fa-docker"></i> Docker
                            </span>
                            <span class="skill-badge">
                                <i class="fas fa-code"></i> Prettier
                            </span>
                            <span class="skill-badge">
                                <i class="fas fa-database"></i> Prisma ORM
                            </span>
                            <span class="skill-badge">
                                <i class="fab fa-git"></i> Git & GitHub
                            </span>
                            <span class="skill-badge">
                                <i class="fas fa-cube"></i> REST APIs
                            </span>
                            <span class="skill-badge">
                                <i class="fas fa-cogs"></i> System Design
                            </span>
                            <span class="skill-badge">
                                <i class="fab fa-flutter"></i> Flutter
                            </span>
                            <span class="skill-badge">
                                <i class="fab fa-apple"></i> iOS Development
                            </span>
                            <span class="skill-badge">
                                <i class="fab fa-android"></i> Android Development
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" style="background: white;">
            <div class="container">
                <h2 class="section-title">บริการ</h2>
                <p class="section-subtitle">บริการที่ฉันสามารถให้คุณได้</p>
                
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="service-card">
                            <h5><i class="fas fa-code"></i> พัฒนาซอฟต์แวร์</h5>
                            <p>การพัฒนาเว็บแอปพลิเคชันแบบสมบูรณ์โดยใช้เทคโนโลยีสมัยใหม่และแนวทางปฏิบัติที่ดีที่สุด</p>
                            <ul style="text-align: left; color: #666; list-style: none; padding-left: 0;">
                                <li>✓ แอปพลิเคชันเว็บแบบเต็มสเตก</li>
                                <li>✓ พัฒนา RESTful API</li>
                                <li>✓ ออกแบบและปรับเหมาะสมฐานข้อมูล</li>
                                <li>✓ Docker containerization</li>
                                <li>✓ ปรับปรุงประสิทธิภาพ</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="service-card">
                            <h5><i class="fas fa-mobile-alt"></i> พัฒนา Mobile</h5>
                            <p>สร้างแอปพลิเคชัน Mobile ที่ทำงานบนหลาย Platform สำหรับ iOS และ Android โดยใช้ Flutter</p>
                            <ul style="text-align: left; color: #666; list-style: none; padding-left: 0;">
                                <li>✓ พัฒนาแอป Flutter</li>
                                <li>✓ ความเข้ากันได้ iOS & Android</li>
                                <li>✓ ประสิทธิภาพระดับเนทีฟ</li>
                                <li>✓ ใช้งาน UI/UX</li>
                                <li>✓ เผยแพร่ไปยัง App Store</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="service-card">
                            <h5><i class="fas fa-headset"></i> บริการ IT และการบำรุงรักษา</h5>
                            <p>บริการสนับสนุน IT ที่เป็นมืออาชีพเพื่อให้ระบบของคุณทำงานได้ราบรื่นและปลอดภัย</p>
                            <ul style="text-align: left; color: #666; list-style: none; padding-left: 0;">
                                <li>✓ การบำรุงรักษาและอัปเดตระบบ</li>
                                <li>✓ การแก้ไขปัญหาทางเทคนิค</li>
                                <li>✓ ปรับเหมาะสมประสิทธิภาพ</li>
                                <li>✓ การตรวจสอบความปลอดภัย</li>
                                <li>✓ บริการสนับสนุน 24/7</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section style="background: #f8f9fa;">
            <div class="container">
                <h2 class="section-title">เกี่ยวกับตัวฉัน</h2>
                <p class="section-subtitle">เส้นทางของฉันในวงการเทคโนโลยี</p>
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="about-text" style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                            <p>
                                ฉันเป็นนักพัฒนาแบบเต็มสเตกและผู้ให้บริการ IT ที่มีความหลงใหลและมีประสบการณ์มากมายในการสร้างเว็บแอปพลิเคชันที่ปรับขนาดได้ แอปพลิเคชัน Mobile และการบำรุงรักษาโครงสร้าง IT ที่แข็งแรง
                            </p>
                            <p style="margin-top: 1.5rem;">
                                ความเชี่ยวชาญของฉันครอบคลุมเฟรมเวิร์กพัฒนาสมัยใหม่รวมถึง Flutter สำหรับพัฒนา Mobile ข้ามแพลตฟอร์ม (iOS และ Android) การจัดการฐานข้อมูลแบบครบวงจร containerization และโซลูชัน IT ฉันมุ่งมั่นในการสนับสนุนรหัสคุณภาพสูง ปรับเหมาะสมประสิทธิภาพ และให้บริการสนับสนุนที่เชื่อถือได้เพื่อให้ระบบทำงานได้อย่างมีประสิทธิภาพ
                            </p>
                            <p style="margin-top: 1.5rem;">
                                ไม่ว่าคุณจะต้องการเว็บแอปพลิเคชันที่กำหนดเอง แอปพลิเคชัน Mobile หรือบริการสนับสนุน IT ที่เป็นมืออาชีพ ฉันอยู่ที่นี่เพื่อช่วยให้แนวคิดของคุณกลายเป็นความเป็นจริงด้วยเทคโนโลยีสมัยใหม่และแนวทางปฏิบัติที่ดีที่สุด
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" style="background: white;">
            <div class="container">
                <h2 class="section-title">มาเชื่อมต่อกัน</h2>
                <p class="section-subtitle">พร้อมที่จะเริ่มโปรเจกต์ถัดไปหรือเป็นอย่างไร</p>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <p style="font-size: 1.1rem; color: #666; margin-bottom: 3rem; line-height: 1.7;">
                            ฉันสนใจที่ได้ยินเกี่ยวกับโปรเจกต์ใหม่และโอกาสต่างๆ เสมอ โปรดติดต่อฉันผ่านวิธีการใดวิธีการหนึ่งด้านล่าง
                        </p>
                        <div style="margin-bottom: 2rem;">
                            <a href="mailto:clin@example.com" class="btn btn-lg btn-primary-custom" style="color: white; margin-right: 1rem; margin-bottom: 1rem;">
                                <i class="fas fa-envelope"></i> ส่งอีเมล
                            </a>
                            <a href="tel:+1234567890" class="btn btn-lg btn-outline-primary" style="margin-bottom: 1rem;">
                                <i class="fas fa-phone"></i> โทรหา
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <h5 style="margin-bottom: 1rem; font-weight: 700; color: #f093fb;">Clin tun</h5>
                <p>นักพัฒนาแบบเต็มสเตก และ ผู้ให้บริการด้าน IT</p>
                <p style="margin: 1rem 0; opacity: 0.8; font-size: 0.9rem;">
                    เชี่ยวชาญด้าน PHP • Laravel • Next.js • MySQL • NoSQL • Docker • Prisma • Flutter
                </p>
                <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.1);">
                    <p style="margin-bottom: 0.5rem; opacity: 0.8;">&copy; 2024 Clin tun - สงวนลิขสิทธิ์ทั้งหมด</p>
                    <p style="margin: 0; opacity: 0.7; font-size: 0.85rem;">สร้างความเป็นเลิศในด้านดิจิทัลด้วยเทคโนโลยีสมัยใหม่</p>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
                
         

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
