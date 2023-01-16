<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use PhpParser\Node\Expr\Cast\Array_;

class ReservationStoreRequest extends FormRequest
{
    
    public Array $timingErrors = array();
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function getValidatorInstance(){
        
        $this->getTimingErrors();
    
        parent::getValidatorInstance();
    }
    public function rules()
    {
        return [
            'email' => 'email|unique:users',
            'tel' => 'string|max:15|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
            'heure_debut'=> ['required','regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/'],
            'heure_fin'=> ['required','regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/'],
            'date_reservation'=> ['required', 'date_format:Y-m-d'],
            'nbrpersonne'=> ['required', 'int','min:1', 'max:12'],
            'client'=> ['required', 'string:250'],
            'table_id' => ['sometimes', 'required']
        ];
    }
    
    public function messages()
    {   
        $heure_msg = 'Problèmes du requête [:attribute] de reservation.Veuillez nous contacter pour la réparation ou attaque suspendu';
        return ['heure_fin.regex' => $heure_msg,
                'heure_debut' => $heure_msg,
                'required' => 'ce champs :attribute est obligatoire',
                'email.email' => ':attribute forme est incorect ou non acceptable dans notre site',
                'regex' => 'la forme de :attribute est non valide ',
                'nbrpersonne.min' => ':attribute ne peut être moins que 1',
                'nbrpersonne.max' => ':attribute ne peut être plus que 12',
                'unique' => ':attribute est déja dans notre liste'
    ];
    }

    // public static function redirect($data){
    //     return redirect()->back()->withInput();
    // }
    // protected function failedValidation(Validator $validator)
    // {
    //     $errors = (new ValidationException($validator))->errors();

    //     throw new HttpResponseException(
    //         response()->json(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
    //     );
    // }
    public function response(array $errors)
    {
        if ($this->ajax() || $this->wantsJson()) {
            return new JsonResponse($errors, 200);
        }

        return $this->redirector->to($this->getRedirectUrl())
                                        ->withInput($this->except($this->dontFlash))
                                        ->withErrors($errors, $this->errorBag);
    }
    public function withValidator($validator){
            $validator->after(function ($validator) {
                $validator->errors()->add('timingerrors',$this->timingErrors);
            }); 
    }

    public function setTimingErrors(Array $timingErrors){
        $this->timingErrors = $timingErrors;
       // return new JsonResponse($timingErrors, 200); 
    }
    public function getTimingErrors(){
    
    }
    
    
    // public function failedValidation(Validator $validator)
    // {
    //     //$errors['status'] = 'error';
    //     return new JsonResponse($validator->errors(), 200);
    //     //return response()->json($validator->errors());
    // }
    // public function wantsJson()
    // {
    //     return true;
    // }
    
}
