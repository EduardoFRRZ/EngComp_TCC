//Projeto de TCC: Computerized Control for Drone Competition (CCDC).
// Bacharel: Engenharia de Computação.
//Autor: Eduardo Ferrarezi.
 
//Carrega a biblioteca do sensor ultrassonico
#include <Ultrasonic.h>
#include <vibracao.h>
 
//Define os pinos para o trigger e echo do ultrassônico
#define arco_trigger_1 2
#define arco_echo_1 3

#define arco_trigger_2 4
#define arco_echo_2 5

#define arco_trigger_3 6
#define arco_echo_3 7
 
//Inicializa o sensor nos pinos definidos acima
Ultrasonic arco_ultrasonic_1(arco_trigger_1, arco_echo_1);
Ultrasonic arco_ultrasonic_2(arco_trigger_2, arco_echo_2);
Ultrasonic arco_ultrasonic_3(arco_trigger_3, arco_echo_3);

//Variaveis do ultassônico
float cm_arco_ultrassonico_1, cm_arco_ultrassonico_2, cm_arco_ultrassonico_3;
long arco_1_microsec, arco_2_microsec, arco_3_microsec;
int valida_arco_1 = 0, valida_arco_2 = 0, valida_arco_3 = 0;

void prova_1_arcos();

void setup() {
  Serial.begin(9600);
}
 
void loop() {

  prova_1_arcos();
  delay(10);

}

void prova_1_arcos() {
  //Le as informacoes do sensor ultrassônico em centimetros
  arco_1_microsec = arco_ultrasonic_1.timing();
  arco_2_microsec = arco_ultrasonic_2.timing();
  arco_3_microsec = arco_ultrasonic_3.timing();
  
  cm_arco_ultrassonico_1 = arco_ultrasonic_1.convert(arco_1_microsec, Ultrasonic::CM);
  cm_arco_ultrassonico_2 = arco_ultrasonic_2.convert(arco_2_microsec, Ultrasonic::CM);
  cm_arco_ultrassonico_3 = arco_ultrasonic_3.convert(arco_3_microsec, Ultrasonic::CM);

  if (!valida_arco_1) {
    if((cm_arco_ultrassonico_1 <= 38) && (cm_arco_ultrassonico_1 > 3)) {
      valida_arco_1 = 1;
      Serial.print("Arco 1 acionado - ");
      Serial.println(cm_arco_ultrassonico_1);
    }
  }
  if (!valida_arco_2) {
    if((cm_arco_ultrassonico_2 <= 38) && (cm_arco_ultrassonico_2 > 3)) {
      valida_arco_2 = 1;
      Serial.print("Arco 2 acionado - ");
      Serial.println(cm_arco_ultrassonico_2);
    }
  }
  if(!valida_arco_3) {
    if((cm_arco_ultrassonico_3 <= 38) && (cm_arco_ultrassonico_3 > 3)) {
      valida_arco_3 = 1;
      Serial.print("Arco 3 acionado - ");
      Serial.println(cm_arco_ultrassonico_3);
    }
  }  
}
