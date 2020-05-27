// Plataforma (cronometro) + prova 3 (golf)

#include <TimerOne.h>
#include <Ultrasonic.h>

#define bPlataforma 2
#define arco_trigger_1 3
#define arco_echo_1 4

//Inicializa o sensor nos pinos definidos acima
Ultrasonic arco_ultrasonic_1(arco_trigger_1, arco_echo_1);

bool button = false;
int validaPartida = 0, ePartida = 0;

//VARIAVEIS PUBLICAS DO CONTADOR
int hora = 0;
int minuto = 0;
int segundo = 0;
int milesimo = 0;

//Variaveis do ultassônico
float cm_arco_ultrassonico_1;
long arco_1_microsec;
int valida_arco_1 = 0;

//FUNCOES
void contaTempo();
void mostraTempo();
void prova_1_arcos();

void setup() {
  //INICIO DO TIMER
  Timer1.initialize(1000000000);   //TIMER IRA EXECUTAR A CADA 1 MILISEGUNDO (PARAMETRO EM MICROSEGUNDOS)
  Timer1.attachInterrupt(contaTempo);
  
  pinMode(bPlataforma, INPUT);
  Serial.begin(9600);
}

void loop() { 
  button = digitalRead(bPlataforma);
  if ((button == true) && (validaPartida == 0)) {
    if(ePartida == 0) {
      Serial.println(" ");
      Serial.println(" ");
      Serial.println("Esperando partida");
      ePartida = 1;  
    }
  }

  if ((button == true) && (validaPartida > 0)) {
    Timer1.stop();
    Serial.println("FIM");
    mostraTempo();
    valida_arco_1 = 0;
    validaPartida = 0;
    hora = 0;
    minuto = 0;
    segundo = 0;
    milesimo = 0;
    ePartida = 0;  
  }
  
  if(button == false) {
    if(validaPartida == 0) {
      Timer1.start();
      Timer1.attachInterrupt(contaTempo);
      validaPartida++;
    }
    prova_3_golf();   
  } 
}

void contaTempo() {
  milesimo = milesimo + 1;
  if(milesimo >= 999) {
    milesimo = 0;
    segundo++;
  }
  if(minuto >= 59) {
    milesimo = 0;
    segundo = 0;
    minuto++;
  }  
}

void mostraTempo() {
  Serial.print(minuto);
  Serial.print("min :");
  Serial.print(segundo);
  Serial.print("seg :");
  Serial.print(milesimo);
  Serial.println("mil");  
}

void prova_3_golf() {
  //Le as informacoes do sensor ultrassônico em centimetros
  arco_1_microsec = arco_ultrasonic_1.timing();  
  cm_arco_ultrassonico_1 = arco_ultrasonic_1.convert(arco_1_microsec, Ultrasonic::CM);

  if (!valida_arco_1) {
    if((cm_arco_ultrassonico_1 <= 10) && (cm_arco_ultrassonico_1 > 2)) {
      valida_arco_1 = 1;
      Serial.print("Golf OK - ");
      Serial.println(cm_arco_ultrassonico_1);
    }
  }
}
 
