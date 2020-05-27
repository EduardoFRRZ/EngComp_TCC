//Projeto de TCC: Computerized Control for Drone Competition (CCDC).
// Bacharel: Engenharia de Computação.
//Autor: Eduardo Ferrarezi.

//ARDUINO 1 - Prova 1 (Arcos) + Prova 2 (Placas)
 
//Carrega a biblioteca do sensor ultrassonico
#include <Ultrasonic.h>
 
//Define os pinos para o trigger e echo do ultrassônico
#define arco_trigger_1 2
#define arco_echo_1 3
#define arco_trigger_2 4
#define arco_echo_2 5

//Define os pinos do sensor LDR
#define pin_sensorLDR_1 A0
#define pin_sensorLDR_2 A1
 
//Inicializa o sensor nos pinos definidos acima
Ultrasonic arco_ultrasonic_1(arco_trigger_1, arco_echo_1);
Ultrasonic arco_ultrasonic_2(arco_trigger_2, arco_echo_2);
//Ultrasonic arco_ultrasonic_3(arco_trigger_3, arco_echo_3);

//Variaveis do ultassônico
float cm_arco_ultrassonico_1, cm_arco_ultrassonico_2, cm_arco_ultrassonico_3;
long arco_1_microsec, arco_2_microsec, arco_3_microsec;
int valida_arco_1 = 0, valida_arco_2 = 0, valida_arco_3 = 0;

// Variaveis do sensor LDR
int sensor_val_1 = 0, sensor_val_2 = 0, sensor_val_3 = 0;
int valida_placa_X = 0, valida_placa_Y = 0, valida_placa_Z = 0;

void prova_1_arcos();
void prova_2_placas();

void setup() {
  pinMode(pin_sensorLDR_1, INPUT);
  pinMode(pin_sensorLDR_2, INPUT);
  //pinMode(pin_sensorVibracao_3, INPUT);
  Serial.begin(9600);
}
 
void loop() {
  prova_1_arcos();
  prova_2_placas();
}

void prova_1_arcos() {
  //Le as informacoes do sensor ultrassônico em centimetros
  arco_1_microsec = arco_ultrasonic_1.timing();
  arco_2_microsec = arco_ultrasonic_2.timing();
  //arco_3_microsec = arco_ultrasonic_3.timing();
  
  cm_arco_ultrassonico_1 = arco_ultrasonic_1.convert(arco_1_microsec, Ultrasonic::CM);
  cm_arco_ultrassonico_2 = arco_ultrasonic_2.convert(arco_2_microsec, Ultrasonic::CM);
  //cm_arco_ultrassonico_3 = arco_ultrasonic_3.convert(arco_3_microsec, Ultrasonic::CM);

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
  delay(50);  
}

void prova_2_placas() {
  sensor_val_1 = analogRead(pin_sensorLDR_1);
  sensor_val_2 = analogRead(pin_sensorLDR_2);
  if(!valida_placa_X) {
    if(sensor_val_1 < 450) {
      valida_placa_X = 1;
      Serial.print("Placa X acionada - ");
      Serial.println(sensor_val_1);
    }
  }
  if(!valida_placa_Y) {
    if(sensor_val_2 < 450) {
      valida_placa_Y = 1;
      Serial.print("Placa Y acionada - ");
      Serial.println(sensor_val_2);
    }
  }
  delay(50);
}
