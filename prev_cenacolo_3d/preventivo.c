#include <stdio.h>

int main() {
    float costo_energia = 0.005; //costo energia corrente
    float costo_materiale = 0.0; // costo effetivo bobina 
    int tempo = 0;// tempo in minuti
    int grammi = 0;//grammi usati
    float costo_parziale = 0.0; // costo (tempo*costoenergia)
    float costo_tempo = 0.0; // costo tempo
    float costo_totale = 0.0; //costo parziale + il costo della commessa
    int scelta_materiale = 0; //può essere tra pla-tpu-ptg
    int commesse;//commessa è il costo del nostro lavoro
    int uscita=0;

        do{
        printf("Salve inserire i seguenti dati:\n");
            // Raccolta dei dati
            printf("Inserisci il costo del materiale:\n");
            printf("1. 0.03\n");
            printf("2. 0.05\n");
            printf("3. 0.06\n");
            scanf("%d", &scelta_materiale);

            switch (scelta_materiale) {
                case 1:
                    costo_materiale = 0.03;//PLA
                    break;
                case 2:
                    costo_materiale = 0.05;//TPU
                    break;
                case 3:
                    costo_materiale = 0.06;//PTG
                    break;
                default:
                    printf("Scelta non valida.");
                    return 0;
            }

            printf("Inserisci il tempo di stampa in minuti:\n");
            scanf("%d", &tempo);

            printf("Inserisci i grammi usati :\n");
            scanf("%d", &grammi);

            // Calcolo del costo tempo
            costo_tempo = costo_energia * tempo ;
            // Calcolo del costo grammi
            costo_materiale = grammi * costo_materiale;
            // Calcolo del costo parziale
            costo_parziale = costo_tempo + costo_materiale;
            printf("Il costo parziale della stampa 3D è di: %.2f euro\n", costo_parziale);

            printf("Inserisci il numero di commesse: ");
            scanf("%d", &commesse);
            // Calcolo del costo totale
            costo_totale = costo_parziale + commesse;
            printf("Il costo totale della stampa 3D, con commesse, è di: %.2f euro\n", costo_totale);
            printf("vuoi terminare digita (1) se no (0) per continuare:\n");
            scanf("%d",&uscita);
        }while(uscita!=1);
                
        printf("ciao alla prossima");
            return 0;
}
