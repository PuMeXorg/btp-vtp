<?php

namespace App\Http\Controllers;

use App\Mail\LeadReceived;
use App\Models\Lead;
use App\Services\Bitrix24Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function __construct(protected Bitrix24Service $bitrix24) {}

    public function callback(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'name'  => 'nullable|string|max:100',
        ]);

        $lead = Lead::create([
            'name'       => $validated['name'] ?? null,
            'phone'      => $validated['phone'],
            'region'     => session('region'),
            'source_url' => $request->input('source_url', $request->header('referer')),
            'form_type'  => 'callback',
            'status'     => 'new',
        ]);

        $this->bitrix24->createLead($lead);
        $this->notifyByEmail($lead);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Спасибо! Мы перезвоним вам в ближайшее время.',
            ]);
        }

        return back()->with('success', 'Заявка принята! Мы перезвоним вам в ближайшее время.');
    }

    public function order(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'required|string|max:20',
            'email'   => 'nullable|email|max:100',
            'comment' => 'nullable|string|max:2000',
        ]);

        $lead = Lead::create([
            'name'       => $validated['name'],
            'phone'      => $validated['phone'],
            'email'      => $validated['email'] ?? null,
            'comment'    => $validated['comment'] ?? null,
            'region'     => session('region'),
            'source_url' => $request->input('source_url', $request->header('referer')),
            'form_type'  => 'order',
            'status'     => 'new',
        ]);

        $this->bitrix24->createLead($lead);
        $this->notifyByEmail($lead);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Заявка принята! Мы свяжемся с вами в ближайшее время.',
            ]);
        }

        return back()->with('success', 'Заявка принята! Мы свяжемся с вами в ближайшее время.');
    }

    /**
     * Уведомление о новой заявке на email. Сбой почты не должен ломать
     * отправку формы — поэтому всё в try/catch с логированием.
     */
    private function notifyByEmail(Lead $lead): void
    {
        $recipients = collect(explode(',', (string) config('mail.lead_notify')))
            ->map(fn ($email) => trim($email))
            ->filter()
            ->values()
            ->all();

        if (empty($recipients)) {
            return;
        }

        try {
            Mail::to($recipients)->send(new LeadReceived($lead));
        } catch (\Throwable $e) {
            Log::error('Lead email notify failed', [
                'lead_id' => $lead->id,
                'message' => $e->getMessage(),
            ]);
        }
    }
}