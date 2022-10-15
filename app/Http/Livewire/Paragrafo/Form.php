<?php

namespace App\Http\Livewire\Paragrafo;

use App\Models\Artigo;
use App\Models\BaseJuridica;
use App\Models\Capitulo;
use App\Models\Paragrafo;
use App\Services\ParagrafoService;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Form extends Component
{
    // @params
    public $action;
    public $paragrafo;

    // @attributes
    public $status; // [ 0-Inativo | 1-Ativo]
    public $numero;
    public $descricao;
    public $artigo;

    // @filters
    public $capitulo;
    public $baseJuridica;

    // @options
    public $optionsArtigo = [];
    public $optionsCapitulo = [];
    public $optionsBaseJuridica = [];
    public $optionsNumero = [
        '1' => '1°',
        '2' => '2°',
        '3' => '3°',
        '4' => '4°',
        '5' => '5°',
        '6' => '6°',
        '7' => '7°',
        '8' => '8°',
        '9' => '9°',
        '10' => '10°',
        '11' => '11°',
        '12' => '12°',
        '13' => '13°',
        '14' => '14°',
        '15' => '15°',
        '16' => '16°',
        '17' => '17°',
        '18' => '18°',
        '19' => '19°',
        '20' => '20°',
        '21' => '21°',
        '22' => '22°',
        '23' => '23°',
        '24' => '24°',
        '25' => '25°',
        '26' => '26°',
        '27' => '27°',
        '28' => '28°',
        '29' => '29°',
        '30' => '30°',
        '31' => '31°',
        '32' => '32°',
        '33' => '33°',
        '34' => '34°',
        '35' => '35°',
        '36' => '36°',
        '37' => '37°',
        '38' => '38°',
        '39' => '39°',
        '40' => '40°',
        '41' => '41°',
        '42' => '42°',
        '43' => '43°',
        '44' => '44°',
        '45' => '45°',
        '46' => '46°',
        '47' => '47°',
        '48' => '48°',
        '49' => '49°',
        '50' => '50°',
        '51' => '51°',
        '52' => '52°',
        '53' => '53°',
        '54' => '54°',
        '55' => '55°',
        '56' => '56°',
        '57' => '57°',
        '58' => '58°',
        '59' => '59°',
        '60' => '60°',
        '61' => '61°',
        '62' => '62°',
        '63' => '63°',
        '64' => '64°',
        '65' => '65°',
        '66' => '66°',
        '67' => '67°',
        '68' => '68°',
        '69' => '69°',
        '70' => '70°',
        '71' => '71°',
        '72' => '72°',
        '73' => '73°',
        '74' => '74°',
        '75' => '75°',
        '76' => '76°',
        '77' => '77°',
        '78' => '78°',
        '79' => '79°',
        '80' => '80°',
        '81' => '81°',
        '82' => '82°',
        '83' => '83°',
        '84' => '84°',
        '85' => '85°',
        '86' => '86°',
        '87' => '87°',
        '88' => '88°',
        '89' => '89°',
        '90' => '90°',
        '91' => '91°',
        '92' => '92°',
        '93' => '93°',
        '94' => '94°',
        '95' => '95°',
        '96' => '96°',
        '97' => '97°',
        '98' => '98°',
        '99' => '99°',
        '100' => '100°'
    ];

    protected $rules = [
        'numero' => 'required',
        'artigo' => 'required',
    ];

    public function mount($action, Paragrafo $paragrafo)
    {
        Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::Paragrafo->value,
                'text' => 'Paragrafo',
                'icon' => 'pasta'
            ],
            [
                'href' => '#',
                'text' => ucfirst($action),
                'icon' => 'page'
            ]
        ]);

        $this->action = $action;
        if ($this->action != 'incluir' && !is_null($paragrafo->id)) {
            $this->paragrafo    = $paragrafo;
            $this->numero       = $this->paragrafo->numero . "°";
            $this->status       = $this->paragrafo->status;
            $this->descricao    = $this->paragrafo->descricao;
            $this->artigo       = $this->paragrafo->artigo_id;
        }
        if (in_array($this->action, ['incluir'])) {
            $this->montaOptionsBaseJuridica();
        }else{
            $this->artigo = Artigo::findOrFail($this->paragrafo->artigo_id);
            $this->capitulo = Capitulo::findOrFail($this->artigo->artigo_id);
            $this->baseJuridica = $this->capitulo->getBaseJuridicaAndAno();
        }
    }

    // monta option Artigo
    public function montaOptionsBaseJuridica(){

        // Monta as opções do select de base juridica
        $bjs = BaseJuridica::where([
            ['status', '=', '1']
        ])->get();
        if (!count($bjs)) {
            Session::flash('messageFlashData', 'Nenhum Base Jurídica existente para criar um Paragrafo!');
            Session::flash('typeFlashData', 'warning');
            redirect()->route('paragrafoShow');
        }
        foreach ($bjs as $bj) {
            $this->optionsBaseJuridica[$bj->id] = $bj->numero . " / " . $bj->ano;
        }
    }

    public function montaOptionsCapitulo(){

        // se entro neste função é porque a Base Juridica foi alterada, forma refaz as opções
        $this->capitulo = '';
        $this->optionsCapitulo = [];

        if(!empty($this->baseJuridica)){
            
            // Monta as opções do select de Capitulo, amarrados a base juridica escolhida
            $capitulos = Capitulo::where([
                    ['status', '=', '1'],
                    ['base_juridica_id', '=', $this->baseJuridica]
                ]
            )->get();
            if (!count($capitulos)) {
                Session::flash('messageFlashData', 'Nenhum Capitulo existente para criar um Paragrafo!');
                Session::flash('typeFlashData', 'warning');
                redirect()->route('paragrafoShow');
            }
            foreach ($capitulos as $capitulo) {
                $this->optionsCapitulo[$capitulo->id] = $capitulo->numeroRomano;
            }
            $this->artigo = null;
        }
    }

    public function montaOptionsArtigo(){

        // se entro neste função é porque o Capitulo foi alterado, forma refaz as opções
        $this->artigo = '';
        $this->optionsArtigo = [];

        if(!empty($this->capitulo)){
            
            // Monta as opções do select de Artigo, amarrados ao capitulo escolhido
            $artigos = Artigo::where(
                [
                    ['status', '=', '1'],
                    ['capitulo_id', '=', $this->capitulo]
                ]
            )->get();
            if (!count($artigos)) {
                Session::flash('messageFlashData', 'Nenhum Artigo existente para criar um Paragrafo!');
                Session::flash('typeFlashData', 'warning');
                redirect()->route('paragrafoShow');
            }
            foreach ($artigos as $artigo) {
                $this->optionsArtigo[$artigo->id] = $artigo->numero . '°';
            }
            // dd($artigos, $this->optionsArtigo);
        }
    }

    public function submit()
    {
        $this->validate();

        $typeFlashData = '';
        $messageFlashData = '';
        $paragrafoService = new ParagrafoService();

        if ($this->action == 'incluir') {
            $this->status = 1;

            $data = [
                'numero'        => $this->numero,
                'status'        => $this->status,
                'descricao'     => $this->descricao,
                'artigo_id'     => $this->artigo
            ];

            $paragrafoService->create($data);

            $messageFlashData = 'Paragrafo incluído com Sucesso!';
            $typeFlashData = 'success';
        } elseif ($this->action == 'excluir') {
            $paragrafoService->delete($this->paragrafo);

            $messageFlashData = 'Paragrafo excluído com Sucesso!';
            $typeFlashData = 'success';
        } elseif ($this->action == 'inativar') {
            $paragrafoService->inativar($this->paragrafo);

            $messageFlashData = 'Paragrafo inativado com Sucesso!';
            $typeFlashData = 'success';
        }

        Session::flash('messageFlashData', $messageFlashData);
        Session::flash('typeFlashData', $typeFlashData);
        redirect()->route('paragrafoShow');
    }

    public function render()
    {
        return view('livewire.paragrafo.form');
    }
}
