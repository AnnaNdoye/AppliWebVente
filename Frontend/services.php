<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Services - Déco Élégance</title>
   <style>
    /* Variables */
:root {
    --gold: #d4af37;
    --light-gold: #f4e4bc;
    --dark: #333;
    --white: #fff;
    --light-bg: #f9f9f9;
}
/* ========== HEADER & NAVIGATION ========== */
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
    background: linear-gradient(90deg, #d4af37, #f4e4bc);
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
/* Services Header */
.services-header {
    text-align: center;
    padding: 5rem 2rem;
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(244, 228, 188, 0.05));
    margin-bottom: 3rem;
}

.services-header h1 {
    font-size: 2.8rem;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, var(--gold), var(--light-gold));
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}

.services-header p {
    font-size: 1.2rem;
    color: var(--dark);
    max-width: 700px;
    margin: 0 auto;
}

/* Services Grid */
.services-categories {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto 5rem;
    padding: 0 2rem;
}

.service-card {
    background: var(--white);
    border-radius: 10px;
    padding: 2rem;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s, box-shadow 0.3s;
    text-align: center;
    border-top: 4px solid var(--gold);
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
}

.service-icon {
    font-size: 2.5rem;
    color: var(--gold);
    margin-bottom: 1.5rem;
}

.service-card h2 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: var(--dark);
}

.service-card p {
    color: var(--dark);
    margin-bottom: 1.5rem;
    font-size: 1.1rem;
}

.service-features {
    text-align: left;
    margin: 2rem 0;
    list-style: none;
}

.service-features li {
    margin-bottom: 0.8rem;
    padding-left: 1.5rem;
    position: relative;
}

.service-features i {
    color: var(--gold);
    position: absolute;
    left: 0;
    top: 0.2rem;
}

.service-cta {
    background: linear-gradient(135deg, var(--gold), var(--light-gold));
    color: var(--dark);
    border: none;
    padding: 0.8rem 1.5rem;
    border-radius: 30px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    margin-top: 1rem;
    width: 100%;
}

.service-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
}

/* Process Section */
.process-section {
    background-color: var(--light-bg);
    padding: 4rem 2rem;
    text-align: center;
}

.process-section h2 {
    font-size: 2rem;
    margin-bottom: 3rem;
    color: var(--dark);
}

.process-steps {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.process-step {
    background: var(--white);
    padding: 2rem 1.5rem;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    position: relative;
}

.step-number {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--gold), var(--light-gold));
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin: 0 auto 1rem;
}

.process-step h3 {
    margin-bottom: 0.5rem;
    color: var(--dark);
}

.process-step p {
    color: var(--dark);
    font-size: 0.9rem;
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 1000;
    overflow-y: auto;
}

.modal-content {
    background-color: var(--white);
    margin: 5% auto;
    padding: 2rem;
    border-radius: 10px;
    max-width: 800px;
    position: relative;
    animation: modalFadeIn 0.3s;
}

.close-modal {
    position: absolute;
    top: 1rem;
    right: 1.5rem;
    font-size: 2rem;
    color: var(--dark);
    cursor: pointer;
    transition: color 0.3s;
}

.close-modal:hover {
    color: var(--gold);
}

@keyframes modalFadeIn {
    from { opacity: 0; transform: translateY(-50px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive */
@media (max-width: 768px) {
    .services-header {
        padding: 3rem 1rem;
    }
    
    .services-header h1 {
        font-size: 2rem;
    }
    
    .process-steps {
        grid-template-columns: 1fr;
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
                <li><a href="panier.php" style="color: #fff3e0;">Panier</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="services-header">
            <h1>Nos Services Premium</h1>
            <p>Transformez vos espaces avec notre expertise en décoration d'intérieur</p>
        </section>

        <section class="services-categories">
            <!-- Service 1 -->
            <article class="service-card" id="amenagement">
                <div class="service-icon">
                    <i class="fas fa-home"></i>
                </div>
                <h2>Aménagement Intérieur</h2>
                <p>Solutions clés en main pour transformer votre espace de vie</p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Planification spatiale optimisée</li>
                    <li><i class="fas fa-check"></i> Sélection de mobilier sur mesure</li>
                    <li><i class="fas fa-check"></i> Gestion complète du projet</li>
                    <li><i class="fas fa-check"></i> Rendus 3D avant réalisation</li>
                </ul>
                <button class="service-cta" onclick="showModal('amenagement')">Découvrir ce service</button>
            </article>

            <!-- Service 2 -->
            <article class="service-card" id="evenementiel">
                <div class="service-icon">
                    <i class="fas fa-glass-cheers"></i>
                </div>
                <h2>Décoration Événementielle</h2>
                <p>Créons ensemble l'ambiance parfaite pour vos événements</p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Mariages et cérémonies</li>
                    <li><i class="fas fa-check"></i> Événements corporatifs</li>
                    <li><i class="fas fa-check"></i> Décoration thématique</li>
                    <li><i class="fas fa-check"></i> Location de mobilier design</li>
                </ul>
                <button class="service-cta" onclick="showModal('evenementiel')">Découvrir ce service</button>
            </article>

            <!-- Service 3 -->
            <article class="service-card" id="conseil">
                <div class="service-icon">
                    <i class="fas fa-paint-roller"></i>
                </div>
                <h2>Conseil en Décoration</h2>
                <p>Expertise personnalisée pour vos projets déco</p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Diagnostic déco personnalisé</li>
                    <li><i class="fas fa-check"></i> Plan de style sur mesure</li>
                    <li><i class="fas fa-check"></i> Sélection de couleurs et matières</li>
                    <li><i class="fas fa-check"></i> Shopping accompagné</li>
                </ul>
                <button class="service-cta" onclick="showModal('conseil')">Découvrir ce service</button>
            </article>
        </section>

        <!-- Section Processus -->
        <section class="process-section">
            <h2>Notre Processus en 4 Étapes</h2>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h3>Consultation Initiale</h3>
                    <p>Échange sur vos besoins et aspirations</p>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h3>Conception Sur Mesure</h3>
                    <p>Création d'un plan détaillé et sélection d'éléments</p>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h3>Validation</h3>
                    <p>Présentation des propositions et ajustements</p>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h3>Réalisation</h3>
                    <p>Mise en œuvre par notre équipe d'experts</p>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div id="serviceModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal()">&times;</span>
                <div id="modalContent"></div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Déco Élégance. Tous droits réservés.</p>
    </footer>

    <script>// Données des services
const servicesData = {
    amenagement: {
        title: "Aménagement Intérieur",
        description: "Notre service d'aménagement intérieur complet transforme vos espaces de vie en environnements fonctionnels et esthétiques, parfaitement adaptés à votre style de vie.",
        details: `
            <h2>Aménagement Intérieur Complet</h2>
            <p>Nous offrons une solution clé en main pour transformer votre intérieur selon vos goûts et besoins :</p>
            <ul>
                <li><strong>Étude approfondie</strong> de vos besoins et contraintes</li>
                <li><strong>Conception 3D</strong> pour visualiser le résultat final</li>
                <li><strong>Sélection de mobilier</strong> sur mesure ou en catalogue</li>
                <li><strong>Gestion de projet</strong> complète avec suivi régulier</li>
                <li><strong>Coordination</strong> avec artisans et fournisseurs</li>
            </ul>
            <div class="modal-cta">
                <button onclick="location.href='contact.html'">Demander un devis</button>
            </div>
        `,
        image: "images/service-amenagement.jpg"
    },
    evenementiel: {
        title: "Décoration Événementielle",
        description: "Créez l'ambiance parfaite pour vos événements spéciaux avec notre service de décoration sur mesure.",
        details: `
            <h2>Décoration d'Événements sur Mesure</h2>
            <p>Nous concevons des décors uniques pour rendre vos événements inoubliables :</p>
            <ul>
                <li><strong>Mariages</strong> : décoration de salle, mobilier, ambiance lumineuse</li>
                <li><strong>Événements corporatifs</strong> : stands, espaces networking, décoration thématique</li>
                <li><strong>Location</strong> de mobilier design et d'éléments décoratifs</li>
                <li><strong>Coordination</strong> avec les autres prestataires (traiteur, photographe...)</li>
            </ul>
            <div class="modal-cta">
                <button onclick="location.href='contact.html'">Planifier un événement</button>
            </div>
        `,
        image: "images/service-evenementiel.jpg"
    },
    conseil: {
        title: "Conseil en Décoration",
        description: "Bénéficiez de l'expertise de nos décorateurs pour vos projets personnels avec notre service de conseil à la carte.",
        details: `
            <h2>Conseil Personnalisé en Décoration</h2>
            <p>Nos experts vous accompagnent dans vos choix décoratifs :</p>
            <ul>
                <li><strong>Diagnostic déco</strong> de votre espace avec recommandations</li>
                <li><strong>Plan de style</strong> personnalisé avec moodboard</li>
                <li><strong>Sélection de couleurs</strong> et matières adaptées</li>
                <li><strong>Shopping accompagné</strong> chez nos partenaires</li>
                <li><strong>Suivi</strong> à distance de votre projet</li>
            </ul>
            <div class="modal-cta">
                <button onclick="location.href='contact.html'">Prendre rendez-vous</button>
            </div>
        `,
        image: "images/service-conseil.jpg"
    }
};

// Fonctions pour le modal
function showModal(serviceId) {
    const service = servicesData[serviceId];
    const modalContent = `
        <div class="modal-service">
            <div class="modal-service-image">
                <img src="${service.image}" alt="${service.title}">
            </div>
            <div class="modal-service-content">
                <h2>${service.title}</h2>
                <p class="modal-service-description">${service.description}</p>
                ${service.details}
            </div>
        </div>
    `;
    
    document.getElementById('modalContent').innerHTML = modalContent;
    document.getElementById('serviceModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('serviceModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Fermer le modal en cliquant à l'extérieur
window.onclick = function(event) {
    if (event.target == document.getElementById('serviceModal')) {
        closeModal();
    }
}

// Animation au chargement
document.addEventListener('DOMContentLoaded', function() {
    const serviceCards = document.querySelectorAll('.service-card');
    
    serviceCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = `all 0.5s ease ${index * 0.2}s`;
        
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100);
    });
});
</script>
</body>
</html>