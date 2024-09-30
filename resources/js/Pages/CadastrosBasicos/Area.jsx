import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm, usePage } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';



export default function Area({auth, flash, blocos}) {
    const { data, setData, post, processing, errors, reset } = useForm({
        nome: '',
        bloco_id: '',
    });
    const submit = (e) => {
        e.preventDefault();

        post(route('area.create'), {
            onSuccess: () => {reset()},
        });
    };
    console.log(blocos);
    return (
        <AuthenticatedLayout
    user={auth.user}
    header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Áreas</h2>}
>
    <Head title="Página Inicial" />
    
    <form onSubmit={submit} className='max-w-7xl mx-auto sm:px-6 lg:px-8 py-12'>

            <InputLabel htmlFor="nome" value="Nome da Área" />

            <TextInput
                id="nome"
                name="nome"
                value={data.nome}
                className="mt-1 block w-full"
                autoComplete="nome"
                isFocused={true}
                onChange={(e) => setData('nome', e.target.value)}
                required
            />
            {blocos && blocos.length > 0 ?(
                <select
                id="bloco_id"
                name="bloco_id"
                value={data.bloco_id}
                className="mt-1 block w-full"
                onChange={(e) => setData('bloco_id', e.target.value)}
                required
            >
                <option value="">Selecione um bloco</option>
                {blocos.map((bloco) => (
                    <option key={bloco.id} value={bloco.id}>
                        {bloco.nome}
                    </option>
                ))}
            </select>
            ) : <option disabled>Nenhum bloco disponível</option>}
            {flash.success && (
                <div className="my-4 text-sm font-medium text-green-600">
                    {flash.success}
                </div>
            )}
            <PrimaryButton className="ms-4" disabled={processing}>
                Cadastrar
            </PrimaryButton> 
    </form>


</AuthenticatedLayout>
    );
}