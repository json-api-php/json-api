var age = Number(process.argv[2]);

if (age < 10) {
    console.log('нельзя в кино');
}
else
{
    if (age < 20) {
        console.log('только с родителями');
    }
    else
    {
        if (age < 30) {
            console.log('билет по полной стоимости');
        }
        else
        {
            if (age < 40) {
                console.log('скидка 5%');
            }
            else
            {
                if (age < 50) {
                    console.log('скидка 10%');
                }
                else
                {
                    console.log('скидка 30%');
                }
            }
        }
    }
}