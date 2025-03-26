from typing_extensions import Annotated
from pydantic.functional_validators import BeforeValidator

# PyObjectId
PyObjectId = Annotated[str, BeforeValidator(str)]
