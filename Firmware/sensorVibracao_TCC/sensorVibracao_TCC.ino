//Projeto de TCC: Computerized Control for Drone Competition (CCDC).
//Bacharel: Engenharia de Computação.
//Autor: Eduardo Ferrarezi.

//Pinos do sensor de vibracao SW420
#define pin_sensorVibracao_1 2
#define pin_sensorVibracao_2 3
#define pin_sensorVibracao_3 4

// Variaveis do sensor de vibracão
int sensor_val_1 = 0, sensor_val_2 = 0, sensor_val_3 = 0;
int valida_placa_X = 0, valida_placa_Y = 0, valida_placa_Z = 0;

void setup() {
  pinMode(pin_sensorVibracao_1, INPUT);
  pinMode(pin_sensorVibracao_2, INPUT);
  pinMode(pin_sensorVibracao_3, INPUT);
  Serial.begin(9600);
}

void loop() {  
  prova_2_placas();
  delay(50);
}


void prova_2_placas() {
  sensor_val_1 = digitalRead(pin_sensorVibracao_1);
  sensor_val_2 = digitalRead(pin_sensorVibracao_2);
  sensor_val_3 = digitalRead(pin_sensorVibracao_3);
  //Serial.println(sensor_val_1);
  if(!valida_placa_X) {
    if(sensor_val_1 == 1) {
      valida_placa_X = 1;
      Serial.print("Placa X acionada - ");
      Serial.println(sensor_val_1);
    }
  }
  if(!valida_placa_Y) {
    if(sensor_val_2 == 1) {
      valida_placa_Y = 1;
      Serial.print("Placa Y acionada - ");
      Serial.println(sensor_val_2);
    }
  }
  if(!valida_placa_Z) {
    if(sensor_val_3 == 1) {
      valida_placa_Z = 1;
      Serial.print("Placa X acionada - ");
      Serial.println(sensor_val_3);
    }
  }
}
