import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm, usePage } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';



export default function Blocos({auth, flash}) {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('blocos.create'), {
            onSuccess: () => {reset()},
        });
    };
    return (
        <AuthenticatedLayout
    user={auth.user}
    header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Blocos</h2>}
>
    <Head title="Página Inicial" />
    
    <form onSubmit={submit} className='max-w-7xl mx-auto sm:px-6 lg:px-8 py-12'>

            <InputLabel htmlFor="nome" value="Nome do Bloco" />

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
