<?php

namespace App\Livewire\Guru\BahanAjar;

use App\Models\ChatInteraction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Prism;
use Prism\Prism\ValueObjects\Messages\AssistantMessage;
use Prism\Prism\ValueObjects\Messages\UserMessage;

class ChatBot extends Component
{
    public $messages = [];
    public $question, $answer, $user;

    #[On('chat-bot')]
    public function mount() {
        $this->user = User::find(Auth::user()->id);
        // dd($this->user->teacher->id);
        $this->messages = ChatInteraction::where('teacher_id', $this->user->teacher->id)->get();
        // dd($this->messages);

    }
    
    public function render()
    {
        return view('livewire.guru.bahan-ajar.chat-bot');
    }

    public function askQuestion() {
        $conversations = [];
        foreach ($this->messages as $message) {
            $conversations[] = new UserMessage($message->question);
            $conversations[] = new AssistantMessage($message->answer);
        }
        $conversations[] = new UserMessage($this->question);
        
        $response = Prism::text()
            ->using(Provider::Gemini, 'gemini-2.0-flash')
            ->withSystemPrompt('You are a helpful FAQ assistan.')
            ->withMessages($conversations)
            ->asText();

        $this->answer = $response->text;

        DB::beginTransaction();
        try {
            $interaction = ChatInteraction::create([
                'question' =>$this->question,
                'answer' => $this->answer,
                'teacher_id' => $this->user->teacher->id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('eror: '.$e->getMessage());
        }
        $this->dispatch('chat-bot');
        $this->reset('question');
    }
    
    public function removeChat() {
        DB::beginTransaction();
        try {
            ChatInteraction::where('teacher_id', $this->user->teacher->id)->delete();
            DB::commit();
            return redirect()->route('chatbot')->success('Berhasil menghapus chat');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal: '.$e->getMessage());
        }
    }
}
