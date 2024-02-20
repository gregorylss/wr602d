describe('Formulaire de Connexion', () => {
    it('test 1 - connexion OK', () => {
        cy.visit('localhost:8000/login');

        // Entrer le nom d'utilisateur et le mot de passe
        cy.get('#inputEmail').type('test@gmail.com');
        cy.get('#inputPassword').type('password');

        // Soumettre le formulaire
        cy.get('button[type="submit"]').click();

        // Vérifier que l'utilisateur est connecté
        cy.contains('Vous êtes connecté en tant que test !').should('exist');
    });

    it('test 2 - connexion KO', () => {
        cy.visit('localhost:8000/login');

        // Entrer un nom d'utilisateur et un mot de passe incorrects
        cy.get('#inputEmail').type('babab@gmail.com');
        cy.get('#inputPassword').type('jjre');

        // Soumettre le formulaire
        cy.get('button[type="submit"]').click();

        // Vérifier que le message d'erreur est affiché
        cy.contains('Invalid credentials.').should('exist');
    });
});