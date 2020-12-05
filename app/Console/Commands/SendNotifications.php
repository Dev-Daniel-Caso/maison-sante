<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

use App\Appointment;

class SendNotifications extends Command
{
    protected $signature = 'fcm:send';
    protected $description = 'Enviar mensajes vía FCM';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Buscando citas médicas:');
        $now = Carbon::now();


        $headers = ['id', 'schedule_date', 'schedule_time', 'patient_id'];

        $appointmentsTomorrow = $this->getAppointments24Hours($now->copy());
        $this->table($headers, $appointmentsTomorrow->toArray());

        foreach ($appointmentsTomorrow as $appointment) {
            $appointment->patient->sendFCM('No olvides tu cita mañana a esta hora.');
            $this->info('Mensaje FCM enviado 24h antes al paciente (ID): ' . $appointment->patient_id);
        }

        $appointmentsNextHour = $this->getAppointmentsNextHour($now->copy());
        $this->table($headers, $appointmentsNextHour->toArray());

        foreach ($appointmentsNextHour as $appointment) {
            $appointment->patient->sendFCM('Tienes una cita en 1 hora. Te esperamos.');
            $this->info('Mensaje FCM enviado faltando 1h al paciente (ID): ' . $appointment->patient_id);
        }
    }    

    private function getAppointments24Hours($now)
    {
        return Appointment::where('status', 'Confirmada')
            ->where('schedule_date', $now->addDay()->toDateString())
            ->where('schedule_time', '>=', $now->copy()->subMinutes(3)->toTimeString())
            ->where('schedule_time', '<', $now->copy()->addMinutes(2)->toTimeString())
            ->get(['id', 'schedule_date', 'schedule_time', 'patient_id']);
    }

    private function getAppointmentsNextHour($now)
    {
        return Appointment::where('status', 'Confirmada')
            ->where('schedule_date', $now->addHour()->toDateString())
            ->where('schedule_time', '>=', $now->copy()->subMinutes(3)->toTimeString())
            ->where('schedule_time', '<', $now->copy()->addMinutes(2)->toTimeString())
            ->get(['id', 'schedule_date', 'schedule_time', 'patient_id']);
    }
}

