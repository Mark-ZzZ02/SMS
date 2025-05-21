<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-assets/css/styles.css">  
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <title>Prefect of Discipline</title>
</head>
<style>
  .about {
    position: relative;
    height: 100vh;
    background-image: url("css/login-background.jpg");
    background-size: cover;
    background-position: center center;
    padding-top: 10rem;
    z-index: 0;
  }

  .about::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-color: rgba(11, 53, 117, 0.5); /* Adjust alpha here */
    z-index: 1;
    pointer-events: none; /* So it doesn’t block clicks */
  }

  .about * {
    position: relative;
    z-index: 2; 
  }
  
  .nav__item:nth-child(6) .nav__link{
    border: white 2px solid;
    border-radius: 10px;
    padding:  5px 10px;
  }

  .nav__link:hover {
    background-color: aqua;
    padding: 5px 10px;
    border-radius: 10px;
  }

  .contact {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 5rem;
    gap: 5rem;
  }

  .contact__img,.contact__content {
    width: 45%;
  }

  .about h2 {
    color: #fff;
    font-size: 10rem !important;
    text-align: center;
    padding: 0 50px;
    font-family: 'Roboto Condensed';
  }

  #code {
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
  }

  ul li {
    list-style: none;
  }

</style>
<body>
    <!--===== HEADER =====-->
    <header class="l-header">
        <nav class="nav bd-grid">
            <div>
                <a href="#" class="nav__logo">Bestlink - POD</a>
            </div>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="btn nav__item"><a href="#about" class="nav__link active">About</a></li>
                    <li class="btn nav__item"><a href="#activities" class="nav__link">Activities</a></li>
                    <li class="nav__item"><a href="#code" class="nav__link">Student Code of Conduct</a></li>
                    <li class="nav__item"><a href="#sanctions" class="nav__link">Sanctions</a></li>
                    <li class="nav__item"><a href="#contact" class="nav__link">Contact</a></li>
                    <li class="nav__item"><a href="index.php" class="nav__link">Login</a></li>
                </ul>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-menu'></i>
            </div>
        </nav>
    </header>

    <main class="l-main">
        <!--===== ABOUT =====-->
        <section class="about section" id="about">
            <h2 class="about-title">Prefect Of Discipline
            </h2>
            <!-- <div class="about__container bd-grid">
                <div class="about__img">
                    <img src="login-assets/img/prefil1.jpg" alt="">
                </div>
                <div>
                    <h2 class="about__subtitle">Prefect of Discipline</h2>
                    <p class="about__text">
                        The Prefect of Discipline of Bestlink College of the Philippines (BCP) is committed to promoting a safe, 
                        respectful, and orderly learning environment. Our department ensures all students are aware of and adhere 
                        to the school’s policies, fostering personal responsibility, discipline, and integrity.
                        <br><br>
                        We believe that student discipline is essential for personal growth and academic success. Our team regularly 
                        monitors compliance, investigates incidents, and engages with students and parents in resolving behavioral 
                        concerns.
                    </p>
                </div> -->
            </div>
        </section>

        <!--===== ACTIVITIES =====-->
        <section class="skills section" id="activities">
            <h2 class="section-title">Activities</h2>
            <div class="skills__container bd-grid">
                <div>
                    <p class="skills__text">
                        The Prefect of Discipline organizes regular seminars, classroom visits, and behavioral workshops. These 
                        activities aim to educate students about proper conduct, school rules, and life skills such as accountability,
                         communication, and conflict resolution.
                    </p>
                </div>
                <div>
                    <img src="login-assets/img/professional%20skills.gif" alt="" class="skills__img">
                </div>
            </div>
        </section>

        <!--===== STUDENT CODE OF CONDUCT =====-->
        <section class="section" id="code" style="padding: 5rem 2rem; color: white; background-color: rgb(30 24 66); font-family: 'Roboto Condensed', sans-serif;">
            <h2 class="section-title" style="text-align: center; font-size: 2.5rem; margin-bottom: 2rem;">Student Code of Conduct</h2>

            <div style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: space-between;">
                <div style="flex: 1 1 60%; min-width: 300px;">
                <p style="font-size: 1.2rem; line-height: 1.8;">
                    The Code of Conduct outlines the values, expectations, and disciplinary procedures that all students of BCP must follow. This includes punctuality, wearing the prescribed uniform, maintaining academic honesty, respecting others, and avoiding prohibited behaviors.
                </p>
                </div>
            </div>

            <div style="margin-top: 3rem;">
                <h3 style="font-size: 2.5rem; margin-bottom: 1rem; color: aqua;">Types of Offenses & Corresponding Sanctions</h3>

                <h4 style="font-size: 1.8rem; color: #ffcc00;">4.1.1 Minor Offenses</h4>
                <p>Penalties: Reprimand, Probation, Fines. Repeat offenses escalate.</p>
                <ul style="list-style: square; padding-left: 1.5rem; margin-bottom: 2rem;">
                <li>Not wearing of school ID card</li>
                <li>Eating in class, chewing gum</li>
                <li>Loitering in restricted areas</li>
                <li>Public display of affection</li>
                <li>Unauthorized postings</li>
                <li>Spitting or unsanitary acts</li>
                <li>Improper attire or accessories</li>
                <li>Unauthorized use of facilities</li>
                <li>Entering incorrect restrooms</li>
                <li>Improper use of college equipment</li>
                <li>Possession of pointed objects</li>
                <li>Refusal of inspection</li>
                <li>Lewd gestures</li>
                <li>Charging gadgets in classrooms/hallways</li>
                </ul>

                <h4 style="font-size: 1.8rem; color: #ff6600;">4.1.2 Major Offenses</h4>
                <p>Penalties: Suspension (3–15 days), Probation, Semester/year suspension.</p>
                <ul style="list-style: square; padding-left: 1.5rem; margin-bottom: 2rem;">
                <li>Unauthorized removal of property</li>
                <li>Smoking on campus</li>
                <li>Excessive public affection</li>
                <li>Pornographic content possession/distribution</li>
                <li>Vandalism</li>
                <li>Influence of liquor/drugs</li>
                <li>Unauthorized equipment operation</li>
                <li>Disrespect to staff or students</li>
                <li>Illegal classroom or office intrusion</li>
                <li>Bullying, malicious gossip, slander</li>
                <li>Misuse of funds or cheating</li>
                <li>Unauthorized social media groups</li>
                </ul>

                <h4 style="font-size: 1.8rem; color: #ff0033;">4.1.3 Grave Offenses</h4>
                <p>Penalties: Dismissal, Expulsion.</p>
                <ul style="list-style: square; padding-left: 1.5rem; margin-bottom: 2rem;">
                <li>Drug use or possession</li>
                <li>Theft, robbery, dishonesty</li>
                <li>Forgery, tampering documents</li>
                <li>Disrespect to authority or assault</li>
                <li>Criminal conviction or CHED law violation</li>
                <li>ID misuse or impersonation</li>
                <li>Defaming the school online/media</li>
                <li>Cybercrime or social media abuse</li>
                <li>Posting school grievances online</li>
                <li>Weapon possession or explosive use</li>
                <li>Unauthorized digital or facility access</li>
                <li>Fraternity recruitment or hazing</li>
                <li>Inciting violence or disruptions</li>
                <li>Unauthorized fundraising or ticket selling</li>
                </ul>

                <h3 style="font-size: 2.5rem; color: aqua; margin-top: 3rem;">Student Code of Conduct Agreement</h3>
                <p style="font-size: 1.2rem; margin-bottom: 1rem;">As a student/scholar of BCP, I commit to:</p>
                <ul style="list-style: circle; padding-left: 1.5rem;">
                <li>Uphold the school’s values and mission</li>
                <li>Behave appropriately on/off campus</li>
                <li>Respect all members of the school community</li>
                <li>Avoid foul or inappropriate language</li>
                <li>Speak positively and report concerns properly</li>
                <li>Be responsible online:
                    <ul>
                    <li>No inappropriate or malicious content</li>
                    <li>Avoid dishonesty and disrespect online</li>
                    <li>Do not upload or share offensive content</li>
                    <li>Don’t use social media to attack school members</li>
                    </ul>
                </li>
                </ul>
                <p style="margin-top: 1rem;"><strong>Note:</strong> Any online post is considered public. Violations may lead to scholarship cancellation and required fee reimbursement.</p>
            </div>
        </section>

        <!--===== ADMINS =====-->
        <section class="section" id="admins">
            <h2 class="section-title">Admins</h2>
            <div class="about__container bd-grid">
                <div class="about__img">
                    <img src="login-assets/img/profile.gif" alt="Arjay Austria">
                </div>
                <div>
                    <h2 class="about__subtitle">Arjay Austria</h2>
                    <p class="about__text">
                        Arjay Austria is the lead Prefect of Discipline. He has over 10 years of experience in educational 
                        leadership and student affairs. Known for his approachable personality and firm stance on fairness, 
                        he advocates for creating a positive environment for all students.
                    </p>
                </div>
            </div>
            <div class="about__container bd-grid" style="margin-top: 2rem;">
                <div class="about__img">
                    <img src="login-assets/img/profile.gif" alt="Reymondo Hernaes">
                </div>
                <div>
                    <h2 class="about__subtitle">Reymondo Hernaes</h2>
                    <p class="about__text">
                        Reymondo Hernaes serves as an Assistant Prefect of Discipline. He is passionate about youth 
                        mentorship and behavioral development. His role includes coordinating disciplinary programs 
                        and conducting student guidance sessions.
                    </p>
                </div>
            </div>
        </section>

        <!--===== CONTACT =====-->
        <section class="contact section" id="contact">
          <div class="contact__img">
            <img src="login-assets/img/professional skills.gif">
          </div>
          <div class="contact__content">
            <h2 class="section-title">Contact</h2>
            <div class="contact__container bd-grid">
                <form action="https://formsubmit.co/test@email.com" method="POST" class="contact__form">
                    <input type="text" placeholder="Name" class="contact__input" name="name" required>
                    <input type="email" placeholder="Email" class="contact__input" name="email" required>
                    <textarea name="message" cols="0" rows="10" class="contact__input" placeholder="Your Message"></textarea>
                    <input type="submit" value="Submit" class="contact__button button">
                </form>
            </div>
          </div>
        </section>

        <!--===== LOGIN PLACEHOLDER =====-->
        <!-- <section class="skills section" id="login">
            <h2 class="section-title">Login</h2>
            <div class="skills__container bd-grid">
                <div>
                    <p class="skills__text">
                        This portal is reserved for authorized staff and students to report concerns or view conduct records. 
                        <br><br> *Login feature coming soon.*
                    </p>
                </div>
            </div>
        </section> -->
    </main>

    <!--===== FOOTER =====-->
    <footer class="footer">
        <p class="footer__title">Prefect of Discipline - BCP</p>
        <div class="footer__social">
            <a href="https://www.facebook.com/PODofficialpage" class="footer__icon" target="_blank"><i class='bx bxl-facebook'></i></a>
            <a href="https://www.instagram.com/" class="footer__icon" target="_blank"><i class='bx bxl-instagram'></i></a>
            <a href="#" class="footer__icon"><i class='bx bxl-twitter'></i></a>
        </div>
        <p class="footer__copy">&#169; 2025 Bestlink College of the Philippines. All rights reserved.</p>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="login-assets/js/main.js"></script>
</body>
</html>
