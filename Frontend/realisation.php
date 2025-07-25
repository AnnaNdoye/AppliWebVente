<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Réalisations - Déco Élégance</title>
  <style>
    body {
    background-color: #fafafa;
    color: var(--dark);
    line-height: 1.6;
}
  header {
    background-color: rgba(255, 255, 255, 0.98);
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
    padding: 0.5rem 0;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.logo a {
    font-size: 1.8rem;
    font-weight: 700;
    color: #d4af37;
    text-decoration: none;
    background: linear-gradient(135deg, #d4af37, #f4e4bc);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    transition: all 0.3s ease;
}

.logo a:hover {
    opacity: 0.8;
}

nav ul {
    display: flex;
    list-style: none;
    gap: 1.5rem;
    margin: 0;
    padding: 0;
}

.nav-links a:hover::after {
    width: 100%;
}

.nav-links a:hover {
    color:#d4af37 ;
}

nav ul li {
    position: relative;
}

nav ul li a {
    color: #333;
    text-decoration: none;
    font-weight: 500;
    font-size: 1rem;
    padding: 0.5rem 0;
    transition: all 0.3s ease;
    position: relative;
}

nav ul li a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(135deg, #d4af37, #f4e4bc);
    transition: width 0.3s ease;
}

nav ul li a:hover::after {
    width: 100%;
}

nav ul li a:hover {
    color: #d4af37;
}

nav ul li a.active {
    color: #d4af37;
    font-weight: 600;
}

nav ul li a.active::after {
    width: 100%;
}

/* ========== MENU BURGER (VERSION MOBILE) ========== */
.menu-toggle {
    display: none;
    cursor: pointer;
    padding: 0.5rem;
}

.menu-toggle span {
    display: block;
    width: 25px;
    height: 2px;
    background-color: #333;
    margin: 5px 0;
    transition: all 0.3s ease;
}

/* ========== MEDIA QUERIES ========== */
@media (max-width: 768px) {
    nav {
        flex-wrap: wrap;
        padding: 1rem;
    }
    
    .menu-toggle {
        display: block;
        order: 1;
    }
    
    .logo {
        order: 2;
        flex-grow: 1;
        text-align: center;
    }
    
    nav ul {
        order: 3;
        width: 100%;
        flex-direction: column;
        display: none;
        margin-top: 1rem;
    }
    
    nav ul.active {
        display: flex;
    }
    
    nav ul li {
        margin: 0.3rem 0;
    }
    
    nav ul li a {
        display: block;
        padding: 0.8rem 1rem;
    }
    
    .menu-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }
    
    .menu-toggle.active span:nth-child(2) {
        opacity: 0;
    }
    
    .menu-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -6px);
    }
}

main {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 2rem;
}

.page-header {
    text-align: center;
    margin-bottom: 3rem;
    padding: 2rem 0;
}

.page-header h1 {
    font-size: 2.5rem;
    color: var(--gold);
    margin-bottom: 1rem;
    background: linear-gradient(135deg, var(--gold), var(--light-gold));
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}
.page-header p {
    color: var(--dark);
    font-size: 1.1rem;
    max-width: 700px;
    margin: 0 auto;
}
  /* Réalisations */
.realisations-header {
    text-align: center;
    padding: 5rem 2rem;
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(244, 228, 188, 0.05));
}

.realisations-header h1 {
    font-size: 2.8rem;
    margin-bottom: 1rem;
    background:  linear-gradient(135deg, #d4af37, #f4e4bc);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}

.realisations-header p {
    font-size: 1.2rem;
    color: #333;
    max-width: 700px;
    margin: 0 auto 2rem;
}

.filters {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: 2rem;
}

.filter-btn {
    padding: 0.7rem 1.5rem;
    background: none;
    border: 1px solid #d4af37;
    color: #d4af37;
    border-radius: 30px;
    cursor: pointer;
    transition: all 0.3s;
    font-weight: 500;
}

.filter-btn.active,
.filter-btn:hover {
    background: linear-gradient(135deg, #ffa500, #ff8c00);
    color: #333;
    border-color: transparent;
}

/* Galerie Avant/Après */
.before-after-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 3rem;
    max-width: 1300px;
    margin: 3rem auto;
    padding: 0 2rem;
}

.project-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s, box-shadow 0.3s;
}

.project-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.before-after-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    position: relative;
    height: 300px;
}

.before-after-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.before, .after {
    position: relative;
}

.label {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.9rem;
}

.project-info {
    padding: 1.5rem;
}

.project-info h3 {
    font-size: 1.3rem;
    margin-bottom: 0.8rem;
    color: #333;
}

.project-info p {
    color: #555;
    margin-bottom: 1.2rem;
    line-height: 1.5;
}

.project-details {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: 1rem;
}

.project-details span {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.9rem;
    color: #555;
}

.project-details i {
    color: #ffa500;
}

/* Témoignages */
.testimonials {
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.05), rgba(244, 228, 188, 0.1));
    padding: 4rem 2rem;
    text-align: center;
}

.testimonials h2 {
    font-size: 2rem;
    margin-bottom: 3rem;
    color: #333;
}

.testimonial-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    max-width: 1000px;
    margin: 0 auto;
}

.testimonial {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    position: relative;
}

.testimonial::before {
    content: '"';
    position: absolute;
    top: 20px;
    left: 20px;
    font-size: 5rem;
    color: rgba(212, 175, 55, 0.1);
    font-family: serif;
    line-height: 1;
}

.client-photo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 1.5rem;
    border: 3px solid #ff8c00;
}

.client-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.testimonial p {
    font-style: italic;
    color: #555;
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 1;
}

.client-info {
    display: flex;
    flex-direction: column;
}

.client-info strong {
    color: #333;
    margin-bottom: 0.3rem;
}

.client-info span {
    color: #777;
    font-size: 0.9rem;
}

/* Responsive */
@media (max-width: 768px) {
    .before-after-container {
        grid-template-columns: 1fr;
        height: auto;
    }
    
    .before-after-container .after {
        display: none; /* On mobile, show only before by default */
    }
    
    .realisations-header h1 {
        font-size: 2rem;
    }
    
    .testimonials {
        padding: 3rem 1rem;
    }
}

  </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
      
        <nav>
            <div class="logo"><a href="Pageaccueil.html">Déco Élégance</a></div>
            <ul>
                <li><a href="accueilClient.php">Accueil</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="realisation.php">Réalisations</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="about.php">À propos</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="panier.php" style="color: #fff3e0;">Panier</a></li>
        </nav>
  

    </header>

    <main>
        <section class="realisations-header">
            <h1>Nos Réalisations</h1>
            <p>Découvrez des transformations spectaculaires grâce à notre expertise</p>
            <div class="filters">
                <button class="filter-btn active" data-filter="all">Tous</button>
                <button class="filter-btn" data-filter="appartement">Appartements</button>
                <button class="filter-btn" data-filter="maison">Maisons</button>
                <button class="filter-btn" data-filter="bureau">Bureaux</button>
                <button class="filter-btn" data-filter="evenement">Événements</button>
            </div>
        </section>

        <section class="before-after-gallery">
            <!-- Projet 1 -->
            <div class="project-card" data-category="appartement">
                <div class="before-after-container">
                    <div class="before">
                        <img src="https://images.unsplash.com/photo-1610123172763-1f587473048f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fGFwcGFydGVtZW50JTIwYmFuYWx8ZW58MHx8MHx8fDA%3D" alt="Avant projet appartement">
                        <div class="label">Avant</div>
                    </div>
                    <div class="after">
                        <img src="https://images.unsplash.com/photo-1715985160053-d339e8b6eb94?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8YXBwYXJ0ZW1lbnQlMjBsdXhlfGVufDB8fDB8fHww" alt="Après projet appartement">
                        <div class="label">Après</div>
                    </div>
                </div>
                <div class="project-info">
                    <h3>Appartement de luxe - Dakar Plateau</h3>
                    <p>Transformation complète d'un appartement des années 90 en espace contemporain</p>
                    <div class="project-details">
                        <span><i class="fas fa-calendar-alt"></i> 3 mois de travaux</span>
                        <span><i class="fas fa-ruler-combined"></i> 120 m²</span>
                        <span><i class="fas fa-palette"></i> Style contemporain</span>
                    </div>
                </div>
            </div>

            <!-- Projet 2 -->
            <div class="project-card" data-category="maison">
                <div class="before-after-container">
                    <div class="before">
                        <img src="https://plus.unsplash.com/premium_photo-1681823751860-304a7010c71d?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8dmlsbGElMjBjb25zdHJ1Y3Rpb258ZW58MHx8MHx8fDA%3D" alt="Avant projet maison">
                        <div class="label">Avant</div>
                    </div>
                    <div class="after">
                        <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fHZpbGxhfGVufDB8fDB8fHww" alt="Après projet maison">
                        <div class="label">Après</div>
                    </div>
                </div>
                <div class="project-info">
                    <h3>Villa familiale - Almadies</h3>
                    <p>Rénovation complète avec extension et aménagement paysager</p>
                    <div class="project-details">
                        <span><i class="fas fa-calendar-alt"></i> 5 mois de travaux</span>
                        <span><i class="fas fa-ruler-combined"></i> 250 m²</span>
                        <span><i class="fas fa-palette"></i> Style afro-moderne</span>
                    </div>
                </div>
            </div>

            <!-- Projet 3 -->
            <div class="project-card" data-category="bureau">
                <div class="before-after-container">
                    <div class="before">
                        <img src="https://images.unsplash.com/photo-1673528076919-a69be48560c6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8ZXNwYWNlJTIwY28lMjB3b3JraW5nfGVufDB8fDB8fHww" alt="Avant projet bureau">
                        <div class="label">Avant</div>
                    </div>
                    <div class="after">
                        <img src="https://plus.unsplash.com/premium_photo-1661931749081-23d69ddb62d1?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZXNwYWNlJTIwYnVyZWF1fGVufDB8fDB8fHww" alt="Après projet bureau">
                        <div class="label">Après</div>
                    </div>
                </div>
                <div class="project-info">
                    <h3>Espace coworking - Ouest Foire</h3>
                    <p>Création d'un espace de travail inspirant et fonctionnel</p>
                    <div class="project-details">
                        <span><i class="fas fa-calendar-alt"></i> 2 mois de travaux</span>
                        <span><i class="fas fa-ruler-combined"></i> 180 m²</span>
                        <span><i class="fas fa-palette"></i> Style industriel chic</span>
                    </div>
                </div>
            </div>

            <!-- Projet 4 -->
            <div class="project-card" data-category="evenement">
                <div class="before-after-container">
                    <div class="before">
                        <img src="https://plus.unsplash.com/premium_photo-1683140516020-28d86d877ee1?q=80&w=1254&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Avant projet événement">
                        <div class="label">Avant</div>
                    </div>
                    <div class="after">
                        <img src="https://images.unsplash.com/photo-1632316962873-47ee3d309f02?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzJ8fGRlY28lMjBtYXJpYWdlfGVufDB8fDB8fHww" alt="Après projet événement">
                        <div class="label">Après</div>
                    </div>
                </div>
                <div class="project-info">
                    <h3>Mariage - Hôtel Terrou-Bi</h3>
                    <p>Décoration événementielle pour un mariage haut de gamme</p>
                    <div class="project-details">
                        <span><i class="fas fa-calendar-alt"></i> 1 semaine de préparation</span>
                        <span><i class="fas fa-users"></i> 200 invités</span>
                        <span><i class="fas fa-palette"></i> Style bohème chic</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonials">
            <h2>Ils nous ont fait confiance</h2>
            <div class="testimonial-container">
                <div class="testimonial">
                    <div class="client-photo">
                        <img src="https://plus.unsplash.com/premium_photo-1661724295894-9f4323058501?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fGZlbW1lJTIwbm9pcnxlbnwwfHwwfHx8MA%3D%3D" alt="Client Aminata Diop">
                    </div>
                    <p>"La transformation de notre appartement a dépassé nos attentes. L'équipe a su comprendre nos besoins et proposer des solutions innovantes."</p>
                    <div class="client-info">
                        <strong>Aminata Diop</strong>
                        <span>Projet Appartement Dakar Plateau</span>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="client-photo">
                        <img src="https://images.unsplash.com/photo-1615109398623-88346a601842?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Client Jean Fall">
                    </div>
                    <p>"Professionalisme et créativité au rendez-vous. Notre espace de travail est maintenant à la fois fonctionnel et inspirant."</p>
                    <div class="client-info">
                        <strong>Jean Fall</strong>
                        <span>Projet Coworking Ouest Foire</span>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Déco Élégance. Tous droits réservés.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Filtrage des projets
    const filterBtns = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Active le bouton cliqué
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            
            // Filtre les projets
            projectCards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Animation avant/après au survol
    const beforeAfterContainers = document.querySelectorAll('.before-after-container');
    
    beforeAfterContainers.forEach(container => {
        const before = container.querySelector('.before');
        const after = container.querySelector('.after');
        
        container.addEventListener('mouseenter', function() {
            before.style.opacity = '0';
            after.style.opacity = '1';
        });
        
        container.addEventListener('mouseleave', function() {
            before.style.opacity = '1';
            after.style.opacity = '0';
        });
        
        // Pour mobile (touch devices)
        container.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                if (before.style.opacity === '0') {
                    before.style.opacity = '1';
                    after.style.opacity = '0';
                } else {
                    before.style.opacity = '0';
                    after.style.opacity = '1';
                }
            }
        });
    });
    
    // Animation au chargement
    const projects = document.querySelectorAll('.project-card');
    const testimonials = document.querySelectorAll('.testimonial');
    
    projects.forEach((project, index) => {
        project.style.opacity = '0';
        project.style.transform = 'translateY(30px)';
        project.style.transition = `all 0.5s ease ${index * 0.2}s`;
        
        setTimeout(() => {
            project.style.opacity = '1';
            project.style.transform = 'translateY(0)';
        }, 100);
    });
    
    testimonials.forEach((testimonial, index) => {
        testimonial.style.opacity = '0';
        testimonial.style.transform = 'translateY(30px)';
        testimonial.style.transition = `all 0.5s ease ${index * 0.3}s`;
        
        setTimeout(() => {
            testimonial.style.opacity = '1';
            testimonial.style.transform = 'translateY(0)';
        }, 300);
    });
});
    </script>
</body>
</html>