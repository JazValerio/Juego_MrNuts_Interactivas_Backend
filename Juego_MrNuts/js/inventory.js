export class Inventory {
    //Chatgpt: quiero hacer un pequeño inventario del personaje, donde se vea los coleccionables que ha recogido, en el que se despliege y se cierre al presionar una tecla, toma en cuenta este código de referencia y esta documentación de phaser (código y documentación de phaser)
    constructor(scene) {
        this.scene = scene;
        this.isVisible = false;
        this.collectibles = {}; // Guarda la cantidad de cada coleccionable, esto es necesario para poder colocar los iconos
    }
    
    create() {
        
        this.background = this.scene.add.image(0, 0, 'inventary')
            .setOrigin(0.5)
            .setVisible(false)
            .setDepth(10)


        this.icons = this.scene.add.group(); 
        this.updateIcons(); 

        // Detectar tecla 
        this.scene.input.keyboard.on('keydown-Q', () => {
            this.isVisible = !this.isVisible;
            this.positionInventary();
            this.background.setVisible(this.isVisible);
            this.updateIcons();
        });
    }

    // chatgpt: A partir de este metodo (metodo pegado) ayudame a controlar que se actualicen los iconos en el inventario, toma en base este codigo (base del método pegado a chat), tomando en cuenta que se dividan por la "key " del objeto y además se acomoden en filas de 4 elemetos cada fila. 
    updateIcons() {
       
        this.icons.clear(true, true);
    
        if (this.isVisible) {
            let xStart = this.background.x - 100;
            let yStart = this.background.y - 100;
            let row = 0;
    
            Object.keys(this.collectibles).forEach((key) => {
               
                for (let i = 0; i < this.collectibles[key]; i++) {
                    let x = xStart + (i % 4) * 75; // Saltar a la siguiente columna cada 4
                    let y = yStart + row * 75;
    
                    const icon = this.scene.add.image(x, y, key === 'fixBox' ? 'fixBoxIcon' : 'powerIcon')
                        .setOrigin(0, 0)
                        .setScale(0.75)
                        .setDepth(10);
    
                    this.icons.add(icon);
    
                    // Saltar a la siguiente fila después de 4 íconos
                    if ((i + 1) % 4 === 0) row++;
                }
    
                // Reiniciar la fila para el siguiente tipo de coleccionable
                row += 1; // Espacio entre diferentes coleccionables
            });
        }
    }
    //metodo creado para poder establecer las coordenadas centrales de la pantalla, ya que sino el inventario aparece en una posicion fija independiente donde se encuntre el personaje
    positionInventary() {
        const cam = this.scene.cameras.main;
        this.background.setPosition(cam.midPoint.x, cam.midPoint.y);
    }

    // Método para añadir coleccionables al inventario
    addItem(type) {
        if (!this.collectibles[type]) {
            this.collectibles[type] = 0;
        }
        this.collectibles[type]++;
        this.updateIcons(); // Actualizar íconos al recoger nuevo coleccionable
    }
}