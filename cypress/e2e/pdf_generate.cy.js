describe('Formulaire de Génération de PDF', () => {
    it('test 1 - génération de PDF avec succès', () => {
        cy.visit('localhost:8000/pdf');

        cy.get('#url').type('https://example.com/');
        cy.get('#title').type('test');

        cy.get('button[type="submit"]').click();

    });
});
