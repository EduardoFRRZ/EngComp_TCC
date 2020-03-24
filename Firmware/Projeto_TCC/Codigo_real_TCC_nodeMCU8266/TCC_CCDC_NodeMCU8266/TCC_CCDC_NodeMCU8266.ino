//Projeto de TCC: Computerized Control for Drone Competition (CCDC).
// Bacharel: Engenharia de Computação.
//Autor: Eduardo Ferrarezi.

//NODEMCU 1 - Prova 1 (Arcos) + Prova 2 (Placas) + Prova 3 (Golf)
 
//Carrega a biblioteca do sensor ultrassonico
#include <Ultrasonic.h>
 
//Define os pinos para o trigger e echo do ultrassônico
#define arco_trigger_1 D0
#define arco_echo_1 D1
#define arco_trigger_2 D2
#define arco_echo_2 D4
#define golf_trigger D5
#define golf_echo D6

//Define os pinos do sensor LDR
#define pin_sensorLDR_1 A0

//Define os pinos do button 
#define bPlataforma D7
 
//Inicializa o sensor nos pinos definidos acima
Ultrasonic arco_ultrasonic_1(arco_trigger_1, arco_echo_1);
Ultrasonic arco_ultrasonic_2(arco_trigger_2, arco_echo_2);
Ultrasonic golf_ultrasonic(golf_trigger, golf_echo);

//Variaveis do ultassônico
float cm_arco_ultrassonico_1, cm_arco_ultrassonico_2, cm_golf_ultrassonico;
long arco_1_microsec, arco_2_microsec, golf_microsec;
int valida_arco_1 = 0, valida_arco_2 = 0, valida_golf = 0;

// Variaveis do sensor LDR
int sensor_val_1 = 0, sensor_val_2 = 0, sensor_val_3 = 0;
int valida_placa_X = 0, valida_placa_Y = 0, valida_placa_Z = 0;

//Variaveis do button
bool button = false;
int validaPartida = 0, ePartida = 0, ePlataforma = 0, alteraDrone = 0;

//Anula entrar na função
int p = 0, g = 0;

void prova_1_arcos();
void prova_2_placas();
void prova_3_gof();

void setup() {
  pinMode(bPlataforma, INPUT);
  pinMode(pin_sensorLDR_1, INPUT);
  Serial.begin(9600);
}
 
void loop() {
  button = digitalRead(bPlataforma);

  if ((button == false) && (validaPartida == 0) && (ePlataforma == 0)) {
    delay (3000);
    Serial.println("Plataforma vazia");
    ePlataforma = 1;
    alteraDrone = 1;
  }
  
  if ((button == true) && (validaPartida == 0) && (alteraDrone == 1)) {
    if(ePartida == 0) {
      Serial.println(" ");
      Serial.println(" ");
      Serial.println("Esperando decolagem...");
      ePartida = 1;
    }
  }

  if ((button == false) && (ePartida == 1)) {
    prova_1_arcos();
    if(!p){prova_2_placas();}
    if(!g){prova_3_gof();}
    validaPartida = 1;
  }

  if ((button == true) && (validaPartida > 0)) {
    Serial.println("FIM");
    valida_arco_1 = 0;
    valida_arco_2 = 0;
    valida_golf = 0;
    valida_placa_X = 0;
    validaPartida = 0;
    ePartida = 0;
    ePlataforma = 0;
    alteraDrone = 0;
    p = 0;
    g = 0;  
  }
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
  delay(10);  
}

void prova_2_placas() {
  sensor_val_1 = analogRead(pin_sensorLDR_1);
  if(!valida_placa_X) {
    if(sensor_val_1 > 300) {
      valida_placa_X = 1;
      Serial.print("Placa acionada - ");
      Serial.println(sensor_val_1);
      p = 1;
    }
  } 
  delay(10);
}

void prova_3_gof() {

  //Le as informacoes do sensor ultrassônico em centimetros
  golf_microsec = golf_ultrasonic.timing();;
  
  cm_golf_ultrassonico = golf_ultrasonic.convert(golf_microsec, Ultrasonic::CM);

  if (!valida_golf) {
    if((cm_golf_ultrassonico <= 10) && (cm_golf_ultrassonico >= 1)) {
      valida_golf = 1;
      Serial.print("golf acionado - ");
      Serial.println(cm_golf_ultrassonico);
      g = 1;
    }
  }
  delay(10);
}
