describe('Formulaire d\'Inscription', () => {
    it('test 1 - inscription OK', () => {
        cy.visit('localhost:8000/register');

        // Remplir les champs du formulaire
        cy.get('#registration_form_email').type('test2@gmail.com');
        cy.get('#registration_form_lastName').type('test2');
        cy.get('#registration_form_firstName').type('test2');
        cy.get('#registration_form_plainPassword').type('password');
        cy.get('#registration_form_agreeTerms').check();


        // Soumettre le formulaire
        cy.get('button[type="submit"]').click();

    });
});
