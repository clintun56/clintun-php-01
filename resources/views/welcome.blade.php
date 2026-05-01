<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Clin tun - Full Stack Developer & IT Support</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <link href="{{ asset('css/portfolio.css') }}" rel="stylesheet">
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
                        
                        <li class="nav-item"><a class="nav-link" href="#dashboard">แดชบอร์ด</a></li>
                        
                        @if (session('user'))
                            <li class="nav-item" style="margin-left: 20px; display: flex; align-items: center; gap: 15px;">
                                <div style="display: flex; align-items: center; gap: 10px; background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(240, 147, 251, 0.15) 100%); padding: 8px 16px; border-radius: 20px; border: 1.5px solid rgba(102, 126, 234, 0.3); transition: all 0.3s ease;">
                                    <i class="fas fa-user-circle" style="color: #667eea; font-size: 1.2rem;"></i>
                                    <span style="color: white; font-weight: 600; font-size: 0.9rem;">
                                        {{ session('user')['name'] }}
                                    </span>
                                </div>
                                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-light" style="border: 2px solid rgba(255,255,255,0.5); transition: all 0.3s ease; font-weight: 600; padding: 6px 14px;">
                                        <i class="fas fa-sign-out-alt"></i> ออก
                                    </button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item" style="margin-left: 20px;">
                                <a href="{{ route('google.login') }}" class="btn btn-sm btn-primary-custom" style="color: white;">
                                    <i class="fab fa-google"></i> เข้าสู่ระบบด้วย Google
                                </a>
                            </li>
                        @endif
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
