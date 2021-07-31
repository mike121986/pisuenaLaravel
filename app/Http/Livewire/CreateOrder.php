<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Models\Order;
use App\Models\City;
use App\Models\District;
use Gloudemans\Shoppingcart\Facades\Cart;

class CreateOrder extends Component
{

    /* sincronizamos alpine con este componenete para saber que radiobutton pulsamos */
    public $envio_type = 1;
    /* se sicroniza para saber si esta lleno el input  */
    public $contact;
    public $phone;
    /* estas propiedades nops ayudan teenere el control de los inputs de direccion y referencia */
    public $addres;
    public $reference;
    public $shipping_cost = 0; /* esta variable guarda el costo de envio  */

    public $departments;
    public $cities = [];
    public $districts = [];
    /* declaramos estas varibles, para que se guarden los id que hemos seleccionadoS */
    public $department_id = "";
    public $city_id = "";
    public $district_id = "";
    /* reglas de validacion */
    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'envio_type' => 'required'
    ];
    
    public function mount()
    {
       
        $this->departments = Department::all();
    }
    /* vamos a esta a la escucha de cambios en envio_type */
    public function updatedEnvioType($value)
    {
        if ($value == 1) {
            $this->resetValidation([
                'department_id',
                'city_id',
                'district_id',
                'addres',
                'reference'
            ]);
        }
    }
    /* se mantiene a la escucha de la propiedad department id para saber si el envio es por medio gratis o envio a domicilio */
    public function updatedDepartmentId($value)
    {
        $this->cities = City::where('department_id', $value)->get();
        $this->reset('city_id');
    }

    public function updatedCityId($value)
    {
        /* tenemos que saber que ciudad es la que se selecciona para calcular el costo xtra */
        $city = City::find($value);
        $this->shipping_cost = $city->cost;
        $this->districts = District::where('city_id', $value)->get();

        $this->reset('district_id');
    }

    /* al apretar el boton de continuar con la compra verificamos que los datos esten correcrtamente llenos */
    public function create_order()
    {
        /* si envio type (que se necesite que se envie a una direccion ) */
        $rules = $this->rules;
        if ($this->envio_type == 2) {
            $rules['department_id'] = 'required';
            $rules['city_id'] = 'required';
            $rules['district_id'] = 'required';
            $rules['addres'] = 'required';
            $rules['reference'] = 'required';
        }

        $this->validate($rules);
        /* si no  se requiere que se envie a una direccion se ocupan esta parte */
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->contact = $this->contact;
        $order->phone = $this->phone;
        $order->envio_type = $this->envio_type;
        $order->shipping_cost = 0;
        $order->total = $this->shipping_cost + Cart::subtotal();
        $order->content = Cart::content();
        /* si se requiere que se envie a una direccion  se agregane estos campos y se modufica shippuing cost */
        if ($this->envio_type == 2) {
            $order->shipping_cost = $this->shipping_cost;
            $order->department_id = $this->department_id;
            $order->city_id = $this->city_id;
            $order->district_id = $this->district_id;
            $order->addres = $this->addres;
            $order->reference = $this->reference;
        }
        $order->save();

        foreach (Cart::content() as $item) {
            discount($item);
        }
        /* eliminamos lo que hay en el carrito de compras */
        Cart::destroy();

        return redirect()->route('orders.payment', $order);
    }
    public function render()
    {
        return view('livewire.create-order');
    }
}
