
    
        // Smooth scrolling pour les liens de navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Animation au scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.product-card, .service-card, .contact-item');
            
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('fade-in');
                }
            });
        }

        window.addEventListener('scroll', animateOnScroll);

        // Modal pour les commandes
        function openModal(productName) {
            document.getElementById('modalTitle').textContent = productName;
            document.getElementById('orderModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('orderModal').style.display = 'none';
        }

        // Modal pour les réservations
        function openBookingModal(serviceName) {
            document.getElementById('bookingModalTitle').textContent = 'Réserver: ' + serviceName;
            document.getElementById('bookingModal').style.display = 'block';
        }

        function closeBookingModal() {
            document.getElementById('bookingModal').style.display = 'none';
        }

        // Fermer les modals en cliquant à l'extérieur
        window.onclick = function(event) {
            const orderModal = document.getElementById('orderModal');
            const bookingModal = document.getElementById('bookingModal');
            
            if (event.target === orderModal) {
                closeModal();
            }
            if (event.target === bookingModal) {
                closeBookingModal();
            }
        }

        // Soumission du formulaire de contact
        function submitForm(event) {
            event.preventDefault();
            
            // Récupération des données du formulaire
            const formData = {
                firstname: document.getElementById('firstname').value,
                lastname: document.getElementById('lastname').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                service: document.getElementById('service').value,
                message: document.getElementById('message').value
            };

            // Simulation d'envoi
            alert('Merci pour votre message ! Nous vous recontacterons dans les plus brefs délais.');
            event.target.reset();
        }

        // Soumission du formulaire de réservation
        function submitBooking(event) {
            event.preventDefault();
            alert('Votre rendez-vous a été enregistré ! Nous vous confirmerons les détails par téléphone.');
            closeBookingModal();
            event.target.reset();
        }

        // Effet parallax léger pour le hero
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero');
            if (hero) {
                hero.style.transform = `translateY(${scrolled * 0.3}px)`;
            }
        });

        // Animation des statistiques au scroll
        function animateStats() {
            const stats = document.querySelectorAll('.stat-number');
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = parseInt(entry.target.textContent);
                        let current = 0;
                        const increment = target / 50;
                        
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= target) {
                                entry.target.textContent = target + (entry.target.textContent.includes('%') ? '%' : entry.target.textContent.includes('ans') ? ' ans' : '+');
                                clearInterval(timer);
                            } else {
                                entry.target.textContent = Math.floor(current) + (entry.target.textContent.includes('%') ? '%' : entry.target.textContent.includes('ans') ? ' ans' : '+');
                            }
                        }, 30);
                        
                        observer.unobserve(entry.target);
                    }
                });
            });

            stats.forEach(stat => observer.observe(stat));
        }

        // Initialisation des animations
        document.addEventListener('DOMContentLoaded', function() {
            animateStats();
            animateOnScroll();
        });
    
        //mon-compte.html

// Gestion des onglets
document.querySelectorAll('.tab-button').forEach(button => {
    button.addEventListener('click', () => {
        const tabId = button.getAttribute('data-tab');
        
        // Retirer la classe active de tous les boutons et contenus
        document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
            content.classList.remove('active');
        });
        
        // Ajouter la classe active au bouton cliqué et au contenu correspondant
        button.classList.add('active');
        const activeContent = document.getElementById(tabId);
        activeContent.classList.remove('hidden');
        activeContent.classList.add('active', 'fade-in');
    });
});

// Simulation de connexion
document.querySelector('#login .auth-form').addEventListener('submit', (e) => {
    e.preventDefault();
    const email = document.getElementById('login-email').value;
    const name = email.split('@')[0]; // Utiliser la partie avant @ comme nom
    
    // Mettre à jour les infos du dashboard
    document.getElementById('dashboard-email').textContent = email;
    document.getElementById('dashboard-name').textContent = name;
    
    // Basculer vers le dashboard
    document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
        content.classList.remove('active');
    });
    
    document.getElementById('dashboard').classList.remove('hidden');
    document.getElementById('dashboard').classList.add('active', 'fade-in');
});

// Simulation d'inscription
document.querySelector('#register .auth-form').addEventListener('submit', (e) => {
    e.preventDefault();
    const password = document.getElementById('register-password').value;
    const confirmPassword = document.getElementById('register-confirm-password').value;
    
    if (password !== confirmPassword) {
        alert('Les mots de passe ne correspondent pas !');
        return;
    }
    
    alert('Inscription réussie ! Vous pouvez maintenant vous connecter.');
    
    // Basculer vers l'onglet connexion
    document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
        content.classList.remove('active');
    });
    
    document.querySelector('[data-tab="login"]').classList.add('active');
    document.getElementById('login').classList.remove('hidden');
    document.getElementById('login').classList.add('active', 'fade-in');
});

// Bouton de déconnexion
document.querySelector('.logout-btn').addEventListener('click', () => {
    // Basculer vers l'onglet connexion
    document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
        content.classList.remove('active');
    });
    
    document.querySelector('[data-tab="login"]').classList.add('active');
    document.getElementById('login').classList.remove('hidden');
    document.getElementById('login').classList.add('active', 'fade-in');
    
    // Réinitialiser les formulaires
    document.querySelectorAll('form').forEach(form => form.reset());
});