package ix.back_end;

import org.springframework.data.repository.CrudRepository;

import ix.back_end.User;

// This will be AUTO IMPLEMENTED by Spring into a Bean called userRepository
// CRUD refers Create, Read, Update, Delete

public interface UserRepository extends CrudRepository<User, Integer> {

}